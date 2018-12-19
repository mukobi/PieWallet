var EC = require('elliptic').ec;
window.ec = new EC('secp256k1');
window.RIPEMD160 = require('ripemd160');
window.keccak = require('keccakjs');