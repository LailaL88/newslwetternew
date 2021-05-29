<?php

class ResultController
    {
        private $model;
        private $input;

        public function __construct($model)
        {
            $this->model = $model;
        }

        private function getSearchInput()
        {
            if (isset($_POST["search"])) {
                $input = htmlspecialchars($_POST["search-input"]);
                $this->model->sql = "SELECT * FROM emails  WHERE email LIKE '%$input%'";
                $_SESSION['provider'] = "";
            }
        }

        private function sortFilter($provider, $input)
        {
            $this->model->sql = 'SELECT * FROM emails';    

            if ($this->model->provider != "" || isset($_POST["by-date"])) {
                $this->model->sql="SELECT * FROM emails WHERE email REGEXP '$provider$' AND email LIKE '%$input%'";    
            }
            
            if (isset($_POST["by-name"])) {
                $this->model->sql="SELECT * FROM emails  WHERE email REGEXP '$provider$' AND email LIKE '%$input%' ORDER BY email";
            }
            
            if (isset($_POST["all"])) {
                $this->model->sql = 'SELECT * FROM emails';
                $_SESSION['provider'] = "";
                $_SESSION['input'] = "";
            } 
        
            $this->getSearchInput();    
        }
        
        private function getButtonTexts($q)
        {
            $this->model->getEmailProviderArray($q);
            foreach ($this->model->uniqueEmailEndings as $value) {
                $dotPos = strpos($value, ".");
                $afterDot = substr($value, $dotPos);
                $buttonText = str_replace($afterDot, "", $value);
                array_push($this->model->capitalisedBtnTexts, ucwords($buttonText));
            }
        }

        private function getProviderVariable()
        {
            foreach ($this->model->uniqueEmailEndings as $value) {
                $dotPos = strpos($value, ".");
                $afterDot = substr($value, $dotPos);
                $buttonText = str_replace($afterDot, "", $value);
                $capitalised = ucwords($buttonText);
        
                if (isset($_POST[$capitalised])) {
                    $_SESSION['provider'] = $value;
                    $this->model->provider = $_SESSION['provider'];
                }
            }
        }

        private function setSessionInput()
        {
            if (isset($_SESSION['input'])) {
                $this->input = $_SESSION['input'];
            } else {
                $this->input = "";
            }
        
            if (isset($_POST["search"])) {
                $this->input = htmlspecialchars($_POST["search-input"]);
                $_SESSION['input'] = $this->input;
            }
        }

        public function callFunctions()
        {
            session_start();
            $this->model->getAllEmails();
            $this->setSessionInput();
            $this->getButtonTexts($this->model->qAll);
            $this->getProviderVariable();
            $this->model->deleteEmail($this->model->rowIds);
            $this->sortFilter($_SESSION['provider'], $this->input);
            $this->model->getEmails();
        }
    }
