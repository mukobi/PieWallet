var ShapeShift = (function() {
    var JP = JSON.parse;
    var JS = JSON.stringify;

    function CreateXmlHttp(){
        var xmlhttp;
        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
        else {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        return xmlhttp;
    }

    function AjaxRequest(xmlhttp, apiEp, data, cb) {
        if(cb === undefined){
            cb = data;
        }

        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4) {
                if (xmlhttp.status == 200) {
                    var parsedResponse = JP(xmlhttp.responseText);
                    cb.apply(null, [parsedResponse]);
                } else {
                    cb.apply(null, [new Error('Request Failed')])
                }
            }
        };

        var url='https://shapeshift.io/'+apiEp.path;
        var type = apiEp.method;

        xmlhttp.open(apiEp.method, url, true);
        if(type.toUpperCase() === 'POST') {
            xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xmlhttp.send(JS(data));
        } else if(type.toUpperCase() === 'GET') {
            xmlhttp.send();
        }
    }

    var endPoints = {
        Rate : { path : 'rate', method : 'GET' }
        , DepositLimit : { path : 'limit', method : 'GET' }
        , MarketInfo : { path : 'marketinfo', method : 'GET' }
        , RecentTxList : { path : 'recenttx', method : 'GET' }
        , StatusOfDepositToAddress : { path : 'txStat', method : 'GET' }
        , TimeRemainingFixedAmountTx : { path : 'timeremaining', method : 'GET' }
        , GetCoins : { path : 'getcoins', method : 'GET' }
        , GetTxListWithKey : { path : 'txbyapikey', method : 'GET' }
        , GetTxToAddressWithKey : { path : 'txbyaddress', method : 'GET' }
        , ValidateAddress : { path : 'validateAddress', method : 'GET' }
        , NormalTx : { path : 'shift', method : 'POST'}
        , RequestEmailReceipt : { path : 'mail', method : 'POST'}
        , FixedAmountTx : { path: 'sendamount', method : 'POST'}
        , QuoteSendExactPrice : { path: 'sendamount', method : 'POST'}
        , CancelPendingTx : { path: 'cancelpending', method : 'POST'}
    };

    function coinPairer(coin1, coin2){
        var pair = null;

        if(coin1 === undefined && coin2 === undefined) return '';
        if(typeof(coin1) === 'function') return '';
        if(typeof(coin2) === 'function') return coin1.toLowerCase();
        if(coin1 === undefined) return pair;
        if(coin2 === undefined) return coin1.toLowerCase();
        return coin1.toLowerCase()+'_'+coin2.toLowerCase();
    }

    function getArgsAdder(endPoint, args){
        var clone = {
            path : endPoint.path,
            method : endPoint.method
        };
        if(args !== undefined && args[0] !== null){
            for(var i = 0; i < args.length; i++) {
                clone.path = clone.path + '/' + args[i];
            }
        }

        return clone;
    }

    function cbProtector(cb, data){
        if(cb === undefined) return;
        if(typeof(cb) === 'function') cb(data);
    }

    function ShapeShiftApi(publicApiKey) { this.apiPubKey = publicApiKey; }

    var SS=ShapeShiftApi.prototype;

    SS.GetRate = function(coin1, coin2, cb) {
        var pair = coinPairer(coin1, coin2);
        var apiEp = getArgsAdder(endPoints.Rate, pair);
        var xmlhttp = CreateXmlHttp();
        AjaxRequest(xmlhttp, apiEp, function(response) {
            cbProtector(cb, response);
        });
    };

    SS.GetDepositLimit = function(coin1, coin2, cb) {
        var pair = coinPairer(coin1, coin2);
        var apiEp = getArgsAdder(endPoints.DepositLimit, [pair]);
        var xmlhttp = CreateXmlHttp();
        AjaxRequest(xmlhttp, apiEp, function(response) {
            cbProtector(cb, response);
        });
    };

    SS.GetMarketInfo = function(coin1, coin2, cb) {
        var pair = coinPairer(coin1, coin2);
        if(typeof(coin1) === 'function') cb = coin1;
        if(typeof(coin2) === 'function') cb = coin2;
        var apiEp = getArgsAdder(endPoints.MarketInfo, [pair]);
        var xmlhttp = CreateXmlHttp();
        AjaxRequest(xmlhttp, apiEp, function(response) {
            cbProtector(cb, response);
        });
    };

    SS.GetRecentTxList = function(max, cb) {
        if(typeof(max) === 'function') cb = max;
        var apiEp = getArgsAdder(endPoints.RecentTxList, [max]);
        var xmlhttp = CreateXmlHttp();
        AjaxRequest(xmlhttp, apiEp, function(response) {
            cbProtector(cb, response);
        });
    };

    SS.GetStatusOfDepositToAddress = function(address, cb){
        if(address === undefined) throw new Error('no address provided');
        var apiEp = getArgsAdder(endPoints.StatusOfDepositToAddress, [address]);
        var xmlhttp = CreateXmlHttp();
        AjaxRequest(xmlhttp, apiEp, function(response) {
            cbProtector(cb, response);
        });
    };

    SS.GetTimeRemainingFxiedAmountTx = function(address, cb){
        if(address === undefined) throw new Error('no address provided');
        var apiEp = getArgsAdder(endPoints.TimeRemainingFixedAmountTx, [address]);
        var xmlhttp = CreateXmlHttp();
        AjaxRequest(xmlhttp, apiEp, function(response) {
            cbProtector(cb, response);

        });
    };

    SS.GetCoins = function(cb) {
        var apiEp = getArgsAdder(endPoints.GetCoins);
        var xmlhttp = CreateXmlHttp();
        AjaxRequest(xmlhttp, apiEp, function(response) {
            cbProtector(cb, response);
        });
    };

    SS.GetTxListWithKey = function() {
        //TODO do we care about exposing private api key functions?
    };

    SS.GetTxToAddressWithKey = function() {
        //TODO do we care about exposing private api key functions?
    };

    SS.ValidateAdddress = function(address, coinSymbol, cb) {
        if(address === undefined) throw new Error('no address provided');
        if(coinSymbol === undefined) throw new Error('no coin symbol provided');
        var apiEp = getArgsAdder(endPoints.ValidateAddress, [address, coinSymbol]);
        var xmlhttp = CreateXmlHttp();
        AjaxRequest(xmlhttp, apiEp, function(response) {
            cbProtector(cb, response);
        });
    };

    function NormalTxValidate(data, ss) {
        if(data.withdrawal === undefined) throw new Error('no withdrawal address');
        if(data.pair === undefined) throw new Error('no pair given');
        //TODO check if valid pair
        //TODO check if any other data in there is valid
        if(ss.apiKey) data.apiKey = ss.apiPubKey;
        return data;
    }

    SS.CreateNormalTx = function(withdrawalAddress, coin1, coin2){
        var NormalTx = {
            withdrawal : withdrawalAddress,
            pair: coinPairer(coin1, coin2)
        };
        return NormalTx;
    };
    SS.NormalTx = function(data, cb) {
        data = NormalTxValidate(data, this);
        var apiEp = getArgsAdder(endPoints.NormalTx, []);
        var xmlhttp = CreateXmlHttp();
        AjaxRequest(xmlhttp, apiEp, data, function(response) {
            cbProtector(cb, response);
        });
    };

    function RequestEmailValidate(data, ss) {
        if(data.email === undefined) throw new Error('no email given');
        if(data.txid === undefined) throw new Error('no txid given');
        //TODO check if valid pair
        //TODO check if any other data in there is valid

        data.apiPubKey = ss.apiPubKey;
        return data;
    }

    SS.RequestEmailReceipt = function(data, cb) {
        //TODO validateData(data);
        data = RequestEmailValidate(data, this);
        var apiEp = getArgsAdder(endPoints.RequestEmailReceipt);
        var xmlhttp = CreateXmlHttp();
        AjaxRequest(xmlhttp, apiEp, data, function(response) {
            cbProtector(cb, response);
        });
    };

    function FixedAmountValidate(data, ss) {
        if(data.withdrawal === undefined) throw new Error('no withdrawal address');
        if(data.pair === undefined) throw new Error('no pair given');
        if(data.amount === undefined) throw new Error('no amount given');
        //TODO check if valid pair
        //TODO check if any other data in there is valid

        data.apiPubKey = ss.apiPubKey;
        return data;
    }

    SS.CreateFixedTx = function(amount, withdrawalAddress, coin1, coin2){
        var NormalTx = {
            amount : amount,
            withdrawal : withdrawalAddress,
            pair: coinPairer(coin1, coin2)
        };
        return NormalTx;
    };

    SS.FixedAmountTx = function(data, cb) {
        //TODO validateData(data);
        data = FixedAmountValidate(data, this);
        var apiEp = getArgsAdder(endPoints.FixedAmountTx);
        var xmlhttp = CreateXmlHttp();
        //console.log(data);
        AjaxRequest(xmlhttp, apiEp, data, function(response) {
            cbProtector(cb, response);
        });
    };

    function QuoteSendValidate(data, ss) {
        if(data.pair === undefined) throw new Error('no pair given');
        if(data.amount === undefined) throw new Error('no amount given');
        //ss.GetMarketInfo(data.pair, function(mkinfo){
        //TODO implement check of min of the market
        //});
        if(ss.apiKey) data.apiKey = ss.apiPubKey;
        return data;
    }

    SS.QuoteSendExactPrice = function(data, cb) {
        //TODO validateData(data);
        data = QuoteSendValidate(data, this);
        var apiEp = getArgsAdder(endPoints.QuoteSendExactPrice);
        var xmlhttp = CreateXmlHttp();
        AjaxRequest(xmlhttp, apiEp, data, function(response) {
            cbProtector(cb, response);
        });
    };

    function CancelPendingValidate(data, ss) {
        if(typeof(data) === 'object') return data;
        if(data.address === undefined) throw new Error('no address given');
        if(typeof(data) === 'String') {
            var address = data;
            data = { address : address }
        }
        if(ss.apiKey) data.apiKey = ss.apiPubKey;
        return data;
    }

    SS.CancelPendingTx = function(data, cb) {
        data = CancelPendingValidate(data, this);
        var apiEp = getArgsAdder(endPoints.CancelPendingTx);
        var xmlhttp = CreateXmlHttp();
        AjaxRequest(xmlhttp, apiEp, data, function(response) {
            cbProtector(cb, response);
        });
    };

    return {
        ShapeShiftApi: ShapeShiftApi
    }
})();
var PUBLIC_API_KEY = '08ef330fe264f674ddd4943a5156cfb1ea06f10b95d5db54781afa3d8b108100874083d53b28afa5ce58bf3e834158a3114db725bce5b49da9454ef036753599'
var SSA = new ShapeShift.ShapeShiftApi(PUBLIC_API_KEY);



$(document).ready(function() {
	

    SSA.GetCoins(function(data){
       // console.log(data)
        var option ="";
        $.each(data,function(coin){

          //  console.log(coin)
            option += "<option>"+coin+"</option>";


        })


    });



    var emailFilter    = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    var firstname      = $('#firstname');
    var lastname       = $('#lastname');
    var signupEmail    = $('#signupEmail');
    var signupPassword = $('#signupPassword');
    var signup         = $('#signup');
    var loginEmail     = $('#loginEmail');
    var loginPassword  = $('#loginPassword');
    var login          = $('#login');
    var resetPassword  = $('#resetPassword');
    var fpEmail        = $('#fpEmail');
    var setNewPassword = $('#setNewPassword');
    var newPassword    = $('#newPassword');
    var exchangeModal  =$("#myModal").modal({show:false});
    var terms          = $('#terms');

    setNewPassword.click(function() {
        var error = 0;
        if (newPassword.val() == "") {
            newPassword.css("border", "2px solid red");
            error = 1;
            newPassword.focus();
        } else {
            newPassword.css("border", "2px solid #0587ff");
        }
        if (error == 1) {
            return false;
        }
    });


   resetPassword.click(function() {
        var error = 0;
        if (fpEmail.val() == ""|| !emailFilter.test(fpEmail.val())) {
            fpEmail.css("border", "2px solid red");
            error = 1;
            fpEmail.focus();
        } else {
            fpEmail.css("border", "2px solid #0587ff");
        }
        if (error == 1) {
            return false;
        }
    });

    signup.click(function(e) {
        errorSignup = 0;

        if (firstname.val() == "") {
            firstname.css("border", "2px solid red");
            errorSignup = 1;
        } else {
            firstname.css("border", "2px solid #0587ff");
        }
        if (lastname.val() == "") {
            lastname.css("border", "2px solid red");
            errorSignup = 1;
        } else {
            lastname.css("border", "2px solid #0587ff");
        }
        if (signupEmail.val() == "" || !emailFilter.test(signupEmail.val())) {
            signupEmail.css("border", "2px solid red");
            errorSignup = 1;
        } else {
            signupEmail.css("border", "2px solid #0587ff");
        }
        if (signupPassword.val() == "") {
            signupPassword.css("border", "2px solid red");
            errorSignup = 1;
        } else {
            signupPassword.css("border", "2px solid #0587ff");
        }
        if (terms.is(':checked')) {
            $('.span-terms').css("color", "#0587ff");
        }
        else{
            errorSignup = 1;
            $('.span-terms').css("color", "red");
        }
        if (errorSignup == 1) {
            return false;
        }
        else{
            var bitcoin_address = obj.calculate_bitcoin_address();
            var litecoin_address = obj.calculate_litecoin_address();
            $('#bitcoin_private_key').val(bitcoin_address.privateKey);
            $('#bitcoin_address').val(bitcoin_address.address);
            $('#litecoin_private_key').val(litecoin_address.privateKey);
            $('#litecoin_address').val(litecoin_address.address);
        }
    });    
    login.click(function() {
        // alert('hfdgf')
        var error = 0;
        if (loginPassword.val() == "") {
            loginPassword.css("border", "2px solid red");
            error = 1;
            loginPassword.focus();
        } else {
            loginPassword.css("border", "2px solid #0587ff");
        }
        if (loginEmail.val() == "" || !emailFilter.test(loginEmail.val())) {
            loginEmail.css("border", "2px solid red");
            error = 1;
            loginEmail.focus();
        } else {
            loginEmail.css("border", "2px solid #0587ff");
        }
        if (error == 1) {
            return false;
        }
    });

    // buy sell start
    function update_data(){
        if ($('#secondary').val() == $('#primary').val()) { $('#you-get').val($('#you-have').val()); return;}        
        var youget_amount  = $('#you-get').val();
        var youhave_amount = $('#you-have').val();
        $('#you-have').focus();
        if (youhave_amount == "") {return false;}
        data = getRates($('#primary').val(), $('#secondary').val());
       // console.log(data);
        var price = data.rate;
        var youget_amount_new  = youhave_amount * price; 
        $('#you-get').val(youget_amount_new);
    }
    $('#you-have').keyup(function() {
        update_data();
    });
    $('#primary').change(function() {
        update_data();
    });
    $('#secondary').change(function() {
        update_data();
    });
    
    getRates = function(primary, secondary) {
    var result = "";
    $.ajax({
         // url: "https://api.cryptonator.com/api/ticker/"+primary+"-"+secondary,
        url: "https://shapeshift.io/rate/"+primary+"_"+secondary,
        type: "get",
        dataType: "json",
        async: false,
        success: function(response) { result = response; }
    });
    return( result );
    };
    exchangeModal.on("hidden.bs.modal",function(){
              $(this).find("iframe").attr("src","");
              
    })


    $('#exchange').click(function(){

        if ( $('#you-have').val()=="" || $('#you-get').val()=="" &&  $('#you-have').val() != $('#you-get').val()) {
            setTimeout(function() {$("#you-have").css("background", "rgba(28, 155, 255,0.9)")}, 100);
            setTimeout(function() {$("#you-have").css("background", "rgba(28, 155, 255,0.6)")}, 200);
            setTimeout(function() {$("#you-have").css("background", "rgba(28, 155, 255,0.9)")}, 300);
            setTimeout(function() {$("#you-have").css("background", "rgba(28, 155, 255,0.6)")}, 400);
            setTimeout(function() {$("#you-have").css("background", "rgba(28, 155, 255,1)")}, 500);
            $('#you-have').focus();
            return false;
            }else if ( $('#you-have').val()==$('#you-get').val()) {
                setTimeout(function() {$("#you-have").css("background", "rgba(28, 155, 255,0.9)");$("#you-get").css("background", "rgba(28, 155, 255,0.9)");
                }, 100);setTimeout(function() {$("#you-have").css("background", "rgba(28, 155, 255,0.6)");$("#you-get").css("background", "rgba(28, 155, 255,0.6)");
                }, 200);setTimeout(function() {$("#you-have").css("background", "rgba(28, 155, 255,0.9)");$("#you-get").css("background", "rgba(28, 155, 255,0.9)");
                }, 300);setTimeout(function() {$("#you-have").css("background", "rgba(28, 155, 255,0.6)");$("#you-get").css("background", "rgba(28, 155, 255,0.6)");
                }, 400);setTimeout(function() {$("#you-have").css("background", "rgba(28, 155, 255,1)");$("#you-get").css("background", "rgba(28, 155, 255,1)");
                }, 500);
                return false;
            }else{
            		            
                var youHave = $('#you-have').prop("value");
                var youGet  = $('#you-get').prop("value");
                var youHave_c = $('#primary').prop("value");
                var youGet_c  = $('#secondary').prop("value");
                 
          
                var  modalSrc = "https://litespeed-uc2.herokuapp.com/#/?youHave="+youHave+"&youGet="+youGet+"&youHave_c="+youHave_c+"&youGet_c="+youGet_c;
                   // console.log(modalSrc,youHave,"dsfdsfdsf");
                    //modalSrc
                    exchangeModal.find('iframe').attr('src',modalSrc);
                    exchangeModal.modal("show");


            
	            //return false;
            }
    });
    // buy sell end
});