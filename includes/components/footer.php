<?php
    function footer($color) {
        $backgroundColor = $color ? '' : ' style="background-color:var(--background-color);"';
        $footer = '<footer class="footer"' . $backgroundColor . '>
            <div class="container footer-container">
                <div class="col-left">
                    <h3 class="emphasized mt-0">CONTACT US</h3>
                    <p class="footer-contact-info"><a href="mailto:enquiry@serene.com" class="footer-contact-email">enquiry@serene.com</a></p>
                    <p class="footer-contact-info">+65 9999 8888</p>
                </div>
                <div class="col-right">
                    <p>Copyright &copy; Serene & Co. All rights reserved.</p>
                </div>
            </div>
        </footer>';
        echo $footer;
    }
?>
