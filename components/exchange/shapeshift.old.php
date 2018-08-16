<div id="shapeshift">
    <?php @session_start(); ?>
    <link rel="stylesheet" href="css/shapeshift.css" />
    <section class="banner">
        <div class="container">
            <form class="conversion-rates" method="post" action="exchangeProcess.php">
                <div class="form-field pr-5">
                    <div class="input-field">
                        <input id="you-have" type="number" name="you have" placeholder="you have">
                        <select class="currency-type" id="primary" name="exchanged_from">
                            <option>ETH</option>
                            <option>ZEC</option>
                            <option>DASH</option>
                            <option>XRP</option>
                            <option>XMR</option>
                            <option>LTC</option>
                        </select>
                    </div>
                    <p id="amount-error" style="color:red"></p>
                </div>
                <div class="form-field pl-5">
                    <div class="input-field">
                        <input id="you-get" readonly="true" type="number" name="you get" placeholder="you Get">
                        <select class="currency-type" id="secondary" name="exchanged_to">
                            <option>LTC</option>
                            <option>ETH</option>
                            <option>ZEC</option>
                            <option>DASH</option>
                            <option>XRP</option>
                            <option>XMR</option>
                        </select>
                    </div>
                </div>
                <div class="switch-icon">
                    <img src="images/SwitchWhite.png">
                </div>
                <div class="form-field exchange-btn">
                    <button id="exchange" type="button" class="btn btn-info btn-lg" >EXCHANGE</button>
                </div>
            </form>
        </div>
    </section>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">ShapeShift</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <iframe src="" width="100%" height="400"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/convert-currency.js?ver=1534402058"></script>
    <script type="text/javascript" src="js/faq-accordian.js"></script>
    <script type="text/javascript" src="js/app_js.js?ver=1534402058"></script>
    <script type="text/javascript" src="js/functions.js?ver=1534402058"></script>
    <script src="js/wow.min.js"></script>
</div>