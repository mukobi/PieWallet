var STRINGS = {
    networkType: "main", // "test" // for testnet
    endpoints: {
        btc: "https://api.blockcypher.com/v1/btc/main",
        // btc: "https://api.blockcypher.com/v1/btc/test3", // BTC testnet
        ltc: "https://api.blockcypher.com/v1/ltc/main",
        eth: "https://api.blockcypher.com/v1/eth/main"
    },
    networkPrefixes: {
        private: {
            btc: "80", // BTC mainnet
            //btc: "ef", // testnet
            ltc: "B0"
        },
        address: {
            btc: "00", // BTC mainnet
            //btc: "6f", // BTC testnet
            ltc: "30"
            //ltc: "6f", // LTC testnet
        }
    }
}