/*
From https://yohanes.gultom.me/2017/10/05/sending-bitcoin-programmatically-using-blockcypher-api/
*/

const request = require('request');
const bitcoin = require("bitcoinjs-lib");
const bitcoinNetwork = STRINGS.networkType == "main" ? 
  bitcoin.networks.bitcoin : bitcoin.networks.testnet;

/**
 * Send bitcoin in testnet using BlockCypher
 * Exported to window.sendBitcoin() for use in smaller script
 * after this one has been browserified
 * @param {number} amount - Bitcoin amount in BTC
 * @param {string} to - output Bitcoin wallet address
 * @param {string} from - input Bitcoin wallet address
 * @param {string} wif 
 */
window.sendBitcoin = function (amount, to, from, wif) {
  let keys = bitcoin.ECPair.fromWIF(wif, bitcoinNetwork);
  return new Promise(function (resolve, reject) {
    // create tx skeleton
    request.post({
      url: STRINGS.endpoints.btc + '/txs/new',
        body: JSON.stringify({
          inputs: [{ addresses: [ from ] }],
          // convert amount from BTC to Satoshis
          outputs: [{ addresses: [ to ], value: Math.round(amount * Math.pow(10, 8)) }]
        }),
      },
      function (err, res, body) {
        if (err) {
          reject(err);        
        } else {
          //console.log(body);
          let tmptx = JSON.parse(body);
          //console.dir(tmptx);
          if(tmptx.errors !== undefined) {
            // show errors to the user
            console.error("Transaction errors found:");
            console.dir(tmptx.errors);
            displayTxErrors(tmptx.errors);
            return;
          }
          // signing each of the hex-encoded string required to finalize the transaction
          tmptx.pubkeys = [];
          //console.dir(keys);
          tmptx.signatures = tmptx.tosign.map(function (tosign, n) {
            tmptx.pubkeys.push(keys.publicKey.toString("hex"));
            let signature = keys.sign(new Buffer(tosign, 'hex'));
            //console.dir(signature);
            let encodedSignature = bitcoin.script.signature.encode(signature,  bitcoin.Transaction.SIGHASH_NONE);    
            let hexStr = encodedSignature.toString("hex");
            return hexStr.substring(0, hexStr.length - 2); // slice off last byte (1 byte sighash version)
          });

          // sending back the transaction with all the signatures to broadcast
          request.post({
            url: STRINGS.endpoints.btc + '/txs/send',
              body: JSON.stringify(tmptx),
            },
            function (err, res, body) {
              if (err) {
                reject(err);
              } else {
                // return tx hash as feedback
                let finaltx = JSON.parse(body);
                console.dir(finaltx);           
                resolve(finaltx.tx.hash);
                displayTxSuccess(finaltx.tx);
              }
            }
          );
        }
      }
    );
  });
}