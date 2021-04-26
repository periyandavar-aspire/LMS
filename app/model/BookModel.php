<?php
/**
 * BookModel File Doc Comment
 * php version 7.3.5
 *
 * @category Model
 * @package  Model
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
/**
 * BookModel Class Handles the BookController class data base operations
 *
 * @category   Model
 * @package    Model
 * @subpackage BookModel
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
class BookModel extends BaseModel
{
    /**
     * Returns all the enabled categories
     *
     * @return array
     */
    public function getCategories(): array
    {
        $category = [];
        $this->db->select('id code', 'name value')
            ->from('category')
            ->where('deletionToken', '=', 'N/A');
        $this->db->where('status', '=', 1)->execute();
        while ($row = $this->db->fetch()) {
            $category[] = $row;
        }
        return $category;
    }

    /**
     * Returns all the enabled authors
     *
     * @return array
     */
    public function getAuthors(): array
    {
        $author = [];
        $this->db->select('id code', 'name value')
            ->from('author')
            ->where('deletionToken', '=', "N/A");
        $this->db->where('status', '=', 1)->execute();
        while ($row = $this->db->fetch()) {
            $author[] = $row;
        }
        return $author;
    }

    /**
     * Adds new book
     *
     * @param array $book Book Details
     *
     * @return boolean
     */
    public function addBook(array $book): bool
    {
        $categories = explode(",", $book['category']);
        $authors = explode(",", $book['author']);
        unset($book['category']);
        unset($book['author']);
        $book['available'] = $book['stack'];
        $this->db->set("autocommit", 0);
        $this->db->begin();
        $flag1 = $flag2 = $flag3 = false;
        $flag1 = $this->db->insert('book', $book)->execute();
        $bookId = $this->db->insertId();
        if ($flag1) {
            foreach ($categories as $categoryId) {
                $category = ['bookId' => $bookId, 'catId' => $categoryId];
                $flag2 = $this->db->insert('book_category', $category)->execute();
                if (!$flag1) {
                    break;
                }
            }
        }
        $flag2 = $this->db->delete('book_author')->where('bookId', '=', $bookId)
            ->execute();
        if ($flag2) {
            foreach ($authors as $authorId) {
                $author = ['bookId' => $bookId, 'authorId' => $authorId];
                $flag3 = $this->db->insert('book_author', $author)->execute();
                if (!$flag3) {
                    break;
                }
            }
        }
        if ($flag1 && $flag2 && $flag3) {
            return $this->db->commit();
        }
        $this->db->rollback();
        return false;
    }

    /**
     * Returns all books
     *
     * @param integer     $start     offset
     * @param integer     $limit     limit value
     * @param string      $sortby    sorting column
     * @param string      $sortDir   sorting direction
     * @param string|null $searchKey search key
     * @param string|null $tcount    stores total records count
     * @param string|null $tfcount   stores filtered records  count
     * 
     * @return array
     */
    public function getBooks(
        int $start = 0,
        int $limit = 10,
        string $sortby = "1",
        string $sortDir = 'ASC',
        ?string $searchKey = null,
        ?string &$tcount = null,
        ?string &$tfcount = null
    ): array {
        $books = [];
        $result = $this->db->select(
            "id",
            "name",
            "location",
            "publication",
            "isbnNumber",
            "stack",
            "available",
            "status"
        )->selectAs(
            "date_format(createdAt, '%d-%m-%Y %h:%i:%s') createdAt",
            "date_format(updatedAt, '%d-%m-%Y %h:%i:%s') updatedAt"
        )->from('book');

        $this->db->where('deletionToken', '=', 'N/A');
        if ($searchKey != null) {
            $this->db->where('name', "LIKE", "%$searchKey%");
        }
        $this->db->orderBy($sortby, $sortDir)
            ->limit($limit, $start)
            ->execute();
        while ($row = $this->db->fetch()) {
            $books[] = $row;
        }
        $this->db->selectAs(
            "COUNT(*) count",
        )->from('book');
        $this->db->where('deletionToken', '=', "N/A")
            ->execute();
        $tcount = $this->db->fetch()->count;
        if ($searchKey != null) {
            $this->db->selectAs(
                "COUNT(*) count",
            )->from('book');
            $this->db->where('deletionToken', '=', "N/A");
            $this->db->where('name', "LIKE", "%$searchKey%")
                ->execute();    
            $tfcount = $this->db->fetch()->count;
        } else {
            $tfcount = $tcount;
        }
        return $books;
    }

    /**
     * Returns enabled books
     *
     * @param int $offset Offset
     * @param int $limit  Row count
     *
     * @return array
     */
    public function getAvailableBooks(
        int $offset = 0,
        int $limit = 12
    ): array {
        $books = [];
        $this->db->select(
            'id',
            'name',
            'authors',
            'description',
            'available',
            'coverPic'
        )->from('book_detail');
        // $this->db->innerJoin('book_author ba')->on('b.id = ba.bookId')
        //     ->innerJoin('author a')
        //     ->on('ba.authorId = a.id');
        $this->db->where('status', '=', 1)//->where('b.deletionToken', '=', 'N/A')
            ->orderby('id', 'desc')
            ->limit($limit, $offset)
            ->execute();
        while ($row = $this->db->fetch()) {
            $books[] = $row;
        }
        return $books;
    }

    /**
     * Returns the book details
     *
     * @param int $bookId Book Id
     *
     * @return object
     */
    public function getBookDetails(int $bookId): object
    {
        $this->db->select(
            'id',
            'name',
            'authors',
            'description',
            'available',
            'coverpic',
            'categories',
            'location',
            'isbnNumber',
            'stack'
        )->from('book_detail');
        $this->db->where('id', '=', $bookId);
        $this->db->where('status', '=', '1')->execute();
        $result = $this->db->fetch();
        // var_export($result);
        return $result;
    }

    /**
     * Deletes the book
     *
     * @param int         $id  Book Id
     * @param string|null $msg Message
     *
     * @return boolean
     */
    public function delete(int $id, ?string &$msg = null): bool
    {
        $this->db->selectAs('count(*) count')
            ->from('issued_book')
            ->innerJoin('status')
            ->on('status.code = issued_book.status')
            ->where('status.value', '=', Constants::STATUS_ISSUED)
            ->where('bookId', '=', $id)
            ->execute();
        if ($this->db->fetch()->count != 0) {
            $msg = "The of the book is issued to the user. Please "
                . "mark those as returned and again make the delete request "
                . "to delete it";
            return false;
        }
        $deletionToken = uniqid();
        $field = [ 'deletionToken' => $deletionToken];
        $this->db->set("autocommit", 0);
        $this->db->begin();
        $flag1 = $flag2 = false;
        $flag1 = $this->db->update('book', $field)->where('id', '=', $id)->execute();
        $flag2 = $this->db->update('issued_book', $field)
            ->where('id', '=', $id)
            ->where('returnAt', '=', Constants::DEFAULT_DATE_VAL)
            ->execute();
        if ($flag1 && $flag2) {
            return $this->db->commit();
        }
        $this->db->rollback();
        return false;
    }

    /**
     * Returns the book details of the given book Id
     *
     * @param int $id Book Id
     *
     * @return object
     */
    public function get(int $id): object
    {
        $this->db->select(
            'id',
            'name',
            'publication',
            'isbnNumber',
            'location',
            'price',
            'stack',
            'description',
            'available',
            'coverPic',
            'authors',
            'authorCodes',
            'categories',
            'categoryCodes'
        )->from('book_detail');
        $this->db->where('id', '=', $id)->execute();
        return $this->db->fetch();
    }

    /**
     * Updates the book details
     *
     * @param array $book   Book details
     * @param int   $bookId Book Id
     *
     * @return boolean
     */
    public function update(array $book, int $bookId): bool
    {
        $flag1 = $flag2 = $flag3 = false;
        $categories = explode(",", $book['category']);
        $authors = explode(",", $book['author']);
        unset($book['category']);
        unset($book['author']);
        $this->db->set("autocommit", 0);
        $this->db->begin();
        $flag1 = $this->db->update('book', $book)
            ->where('id', '=', $bookId)
            ->execute();
        $flag2 = $this->db->delete('book_category')
            ->where('bookId', '=', $bookId)
            ->execute();
        if ($flag2) {
            foreach ($categories as $categoryId) {
                $category = ['bookId' => $bookId, 'catId' => $categoryId];
                $flag2 = $this->db->insert('book_category', $category)->execute();
                if (!$flag2) {
                    break;
                }
            }
        }
        $flag3 = $this->db->delete('book_author')
            ->where('bookId', '=', $bookId)
            ->execute();
        if ($flag3) {
            foreach ($authors as $authorId) {
                $author = ['bookId' => $bookId, 'authorId' => $authorId];
                $flag3 = $this->db->insert('book_author', $author)->execute();
                if (!$flag3) {
                    break;
                }
            }
        }
        if ($flag1 && $flag2 && $flag3) {
            return $this->db->commit();
        }
        return $this->db->rollback();
    }

    /**
     * Returns the cover pic name of the book
     *
     * @param int $id BookId
     *
     * @return string
     */
    public function getCoverPic(int $id): string
    {
        $this->db->select("coverpic")
            ->from("book")
            ->where('id', '=', $id)
            ->execute();
        return $this->db->fetch()->coverpic;
    }
    /**
     * Updates the book details
     *
     * @param array $fields Book details
     * @param int   $id     Book Id
     *
     * @return boolean
     */
    public function updateBook(array $fields, int $id): bool
    {
        $this->db->update('book', $fields)->where('id', '=', $id);
        return $this->db->execute();
    }

    /**
     * Returns the books like given search key
     *
     * @param string $Searchkey Search keys
     *
     * @return array
     */
    public function getBooksLike(string $Searchkey): array
    {
        $result = [];
        $this->db->select("id code", "isbnNumber value")
            ->from('book')
            ->where('isbnNumber', 'LIKE', "%" . $Searchkey . "%");
        $this->db->where('deletionToken', '=', 'N/A')->where('status', '=', 1);
        $orderClause = "case when isbnNumber like '$Searchkey%' THEN 0 ";
        $orderClause .= "WHEN isbnNumber like '% %$Searchkey% %' THEN 1 ";
        $orderClause .= "WHEN isbnNumber like '%$Searchkey' THEN 2 else 3 end,";
        $orderClause .= "isbnNumber";
        $this->db->orderBy($orderClause)->execute();
        while ($row = $this->db->fetch()) {
            $result[] = $row;
        }
        return $result;
    }

    /**
     * Returns the books issued and requested users list
     *
     * @param int $bookId Book Id
     *
     * @return array
     */
    public function getIssuedUsers(int $bookId): array
    {
        $result = [];
        $this->db->select('username', 'status.value status')
            ->from('issued_book ib')
            ->innerJoin('status')
            ->on('status.code = ib.status')
            ->innerJoin('book')
            ->on('book.id = ib.bookId')
            ->innerJoin('user')
            ->on('user.id = ib.userId')
            ->where('book.id', '=', $bookId)
            ->where('status.value', '!=', 'Returned')
            ->where('status.value', '!=', 'Deleted Request')
            ->execute();
        while ($row = $this->db->fetch()) {
            $result[] = $row;
        }
        return $result;
    }

    /**
     * Search th book and returns the search result with given search keys
     *
     * @param string $searchKey Search key
     * @param int    $offset    Offset
     * @param int    $limit     Row count
     *
     * @return array
     */
    public function searchBook(
        string $searchKey,
        int $offset = 0,
        int $limit = 12
    ): array {
        $books = [];
        // $this->db->select(
        //     'b.id id',
        //     'b.name',
        //     'publication',
        //     'isbnNumber',
        //     'location',
        //     'price',
        //     'stack',
        //     'description',
        //     'available',
        //     'coverPic'
        // );
        // $this->db->selectAs(
        //     'GROUP_CONCAT(DISTINCT `a`.`name` SEPARATOR ",") `author`',
        //     'GROUP_CONCAT(DISTINCT `c`.`name` SEPARATOR ",") `category`'
        // )->from('book b');
        // $this->db->leftJoin('book_author ba')->on('b.id = ba.bookid');
        // $this->db->innerJoin('author a')
        //     ->on('(`ba`.`authorId` = `a`.`id`) AND(`a`.`status` = 1)');
        // $this->db->leftJoin('book_category bc')->on('`b`.`id` = `bc`.`bookId`');
        // $this->db->innerJoin('category c')
        //     ->on('(`bc`.`catId` = `c`.`id`) AND(`c`.`status` = 1)');
        // $this->db->where('b.status', '=', 1);
        // $this->db->where('b.deletionToken', '=', 'N/A');
        // $this->db->where(
        //     "(MATCH(b.name, description, publication, isbnNumber) "
        //     . "AGAINST ('$Searchkey')"
        // );
        // $this->db->orWhere("a.name", "LIKE", "%$Searchkey%");
        // $this->db->orWhere("c.name", "LIKE", "%$Searchkey%");
        // $this->db->appendWhere(')');
        // $this->db->groupBy('b.id');
        // $this->db->limit($limit, $offset);
        // $this->db->execute();
        $this->db->runQuery("CALL searchBook('$searchKey', $offset, $limit)");
        while ($row = $this->db->fetch()) {
            $books[] = $row;
        }
        return $books;
    }
}
