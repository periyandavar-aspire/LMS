<?php
class IssuedBooksService extends BaseService
{
    public function checkUserCondition($user, $maxLendBook)
    {
        return ($user->lent < $maxLendBook);
    }
    public function checkLendCondition($user, $book, $maxLendBook, &$msg = null)
    {
        if ($user->id == null) {
            $msg = "The user account is disabled or not exists";
            return false;
        } elseif ($book == false) {
            $msg = "The book is disabled or not exists";
            return false;
        } elseif (!($user->lent < $maxLendBook)) {
            $msg = "Almost lent maximum number of books";
            return false;
        } elseif ($book->available < 1) {
            $msg = "Book is not available to lend";
            return false;
        } else {
            return true;
        }
    }

    public function checkRequestCondition($user, $book, $maxVals, &$msg = null)
    {
        if (!$this->checkLendCondition($user, $book, $maxVals->maxBookLend, $msg)) {
            return false;
        } elseif (!($user->request < $maxVals->maxBookRequest)) {
            $msg = "You almost requested maximum number of book and can't request a book anymore";
            return false;
        }
        return true;
    }
}
