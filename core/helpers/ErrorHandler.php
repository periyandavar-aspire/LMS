<?php
interface ErrorHandler
{
    public function pageNotFound();
    public function invalidRequest();
    public function serverError();
}
