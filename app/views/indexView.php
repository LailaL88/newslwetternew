<?php

class IndexView
{
    private $model;
        
    public function __construct($model) {
        $this->model = $model;
    }

    private function showPageTop()
    {
        echo '
        <!DOCTYPE html>
        <html lang="en">
        
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Newsletter</title>
            <link rel="stylesheet" href="./assets/styles/styles.css">
            <script src="./assets/scripts/scripts.js" defer></script>
        </head>
        
        <body>
            <div class="container">
                <section class="left-side">
                    <nav>
                        <div class="logo">
                            <img src="./assets/img/Union.png" alt="logo">
                            <img class="logo-text" src="./assets/img/pineapple..png" alt="pineapple">
                        </div>
                        <li><a href="#">About</a></li>
                        <li><a href="#">How it works</a></li>
                        <li><a href="#">Contact</a></li>
                    </nav>
        
                    <div class="content-container">
                        <div class="form-container">
                            <h3>Subscribe to newsletter</h3>
                            <p>Subscribe to our newsletter and get 10% discount on pineapple glasses.</p>';
                    if( $this->model->check != "added" ) {
                            echo '
                            <form action="" method="post"
                                onsubmit="return validate(event)" class="form">
                                <div class="text-input-wrapper">
                                    <div class="line"></div>
                                    <input type="text" class="text-input" placeholder="Type your email address here…" name="email" id="email">
                                    <button type="submit" name="submit"
                                        style="padding: 0; border: none; width:max-content;height:14px;outline:none;">
                                        <img class="arrow" src="./assets/img/ic_arrow.jpg"/>
                                    </button>
                                </div>
                                <br>
                                <input type="checkbox" class="checkbox" name="checkbox">
                                <noscript>
                                    <input type="checkbox" class="php-checkbox" name="php-checkbox">
                                </noscript>
                                <span class="mycheckbox"><img src="./assets/img/ic_checkmark.png" alt="checkmark"></span>
                                <label for="checkbox">I agree to <a href="#">terms of service</a></label>
                            </form>
                            ';
                        } else {
                            echo '
                            <div class="success-message">
                                <img src="./assets/img/cup.png" alt="cup" class="cup">
                                <h3>Thanks for subscribing!</h3>
                                <p>You have successfully subscribed to our email listing. Check your email for the discount code.</p>
                            </div>
                            ';
                        }
                        
                        echo '
                        </div>
                        
                        <div class="message"></div>
                        <div class="message-empty"></div>
                        <div class="message-colombia"></div>
                        <div class="checkboxErr"> </div>
                        ';
    }

    private function showCheckboxErrorMessage()
    {
        if ($this->model->checkboxErr != "") {
        echo "<noscript><div class='php-message'>" . $this->model->checkboxErr . "</div></noscript>";
        }
    }

    private function showEmptyEmailErrorMsg()
    {
        if ($this->model->emptyEmailErr != "") {
        echo "<noscript><div class='php-message'>" . $this->model->emptyEmailErr . "</div></noscript>";
        }
    }

    private function showUnvalidEmailErrorMsg()
    {
        if ($this->model->unvalidEmailErr != "") {
            echo "<noscript><div class='php-message'>" . $this->model->unvalidEmailErr . "</div></noscript>";
        }
        if ($this->model->colombiaEmailErr != "") {
            echo "<noscript><div class='php-message'>" . $this->model->colombiaEmailErr . "</div></noscript>";
        }
    }

    private function showPhpValidationMessages()
    {
        $this->showEmptyEmailErrorMsg();    
        $this->showUnvalidEmailErrorMsg();
        $this->showCheckboxErrorMessage();
    }

    private function showPageBottom()
    {
        echo '
                <hr>
                <div class="icon-wrapper">
                    <div class="icon facebook"><i class="fab fa-facebook-f"></i></div>
                    <div class="icon instagram"><i class="fab fa-instagram"></i></div>
                    <div class="icon twitter"><i class="fab fa-twitter"></i></div>
                    <div class="icon youtube"><i class="fab fa-youtube"></i></div>
                </div>
            </div>
            </section>
            <section class="right-side"></section>
            </div>
            <script src="https://kit.fontawesome.com/61c651c0ef.js" crossorigin="anonymous"></script>
            </body>
            </html>
        ';
    }

    public function output()
    {
        $this->showPageTop();
        $this->showPhpValidationMessages();
        $this->showPageBottom();
    }
}
