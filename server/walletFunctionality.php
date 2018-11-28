<?php
    echo $myUserObject;
?>
<script>
// object to hold all info regarding wallet/cryptocurrency integration
var PieWallet = {
    marketValue: {
        btc: 0,
        eth: 0,
        ltc: 0
    },
    balance: {
        btc: 0,
        eth: 0,
        ltc: 0
    },
    publicAddresses: {
        btc: null,
        eth: null,
        ltc: null
    },
    privateKey: {
        key: null
    }
};
</script>