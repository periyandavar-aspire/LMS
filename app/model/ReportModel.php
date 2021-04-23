<?php
/**
 * ManageUserModel File Doc Comment
 * php version 7.3.5
 *
 * @category Model
 * @package  Model
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
/**
 * ReportModel Class Handles the ManageUserController class data base operations
 *
 * @category   Model
 * @package    Model
 * @subpackage ReportModel
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
class ReportModel extends BaseModel
{
    /**
     * Returns Top Books List
     *
     * @param string      $sDate     start date
     * @param string|null $eDate     end date
     * @param integer     $start     offset
     * @param integer     $limit     limit value
     * @param string      $sortby    sorting column
     * @param string      $sortDir   sorting direction
     * @param string      $searchKey search key
     * @param string|null $tcount    stores total records count
     * @param string|null $tfcount   stores filtered records  count
     *
     * @return array
     */
    public function getTopBookList(
        string $sDate = '0000-00-00',
        ?string $eDate = null,
        int $start = 0,
        int $limit = 10,
        string $sortby = "rank",
        string $sortDir = 'DESC',
        string $searchKey = '',
        ?string &$tcount = null,
        ?string &$tfcount = null
    ): array {

        $records = [];
        $this->db->selectAs('count(*) as count')
            ->from('issued_book')
            ->execute();
        $tot = $this->db->fetch()->count;
        $this->db->select(
            'b.name',
            'b.id',
            'isbnNumber',
            'authors',
            'categories',
        )->selectAs(
            'count(ib.bookId) rank'
        )->from('book_detail b')
            ->leftJoin('issued_book ib')
            ->on('b.id = ib.bookId')
            ->where("requestedAt BETWEEN '$sDate' AND '$eDate'");
        if ($searchKey != '') {
            $this->db->where(
                "(b.name LIKE '%$searchKey%'"
                ." OR authors LIKE '%$searchKey%'OR "
                ."isbnNumber LIKE '%$searchKey%'OR "
                ."categories LIKE '%$searchKey%')"
            );
        }
        $this->db->groupBy('b.id');
        $this->db->orderBy($sortby, $sortDir)
            ->limit($limit, $start)
            ->execute();
        while ($row = $this->db->fetch()) {
            $row->impression = round(($row->rank / $tot) * 100, 2) . "%";
            $records[] = $row;
        }
        $this->db->selectAs(
            "COUNT(*) count",
        )->from('book_detail b')
            ->leftJoin('issued_book ib')
            ->on('b.id = ib.bookId')
            ->where("requestedAt BETWEEN '$sDate' AND '$eDate'")
            ->groupBy('b.id')
            ->execute();
        $tcount = $this->db->fetch()->count;
        if ($searchKey != '') {
            $this->db->selectAs(
                "COUNT(*) count",
            )->from('book_detail b')
                ->leftJoin('issued_book ib')
                ->on('b.id = ib.bookId')
                ->where("requestedAt BETWEEN '$sDate' AND '$eDate'");
            $this->db->where(
                "(b.name LIKE '%$searchKey%'"
                ." OR authors LIKE '%$searchKey%'OR "
                ."isbnNumber LIKE '%$searchKey%'OR "
                ."categories LIKE '%$searchKey%')"
            )->groupBy('b.id')
                ->execute();
            $tfcount = $this->db->fetch()->count;
        } else {
            $tfcount = $tcount;
        }
        return $records;
    }

    /**
     * Returns Top Authors List
     *
     * @param string      $sDate     start date
     * @param string|null $eDate     end date
     * @param integer     $start     offset
     * @param integer     $limit     limit value
     * @param string      $sortby    sorting column
     * @param string      $sortDir   sorting direction
     * @param string      $searchKey search key
     * @param string|null $tcount    stores total records count
     * @param string|null $tfcount   stores filtered records  count
     *
     * @return array
     */
    public function getTopAuthorList(
        string $sDate = '0000-00-00',
        ?string $eDate = null,
        int $start = 0,
        int $limit = 10,
        string $sortby = "rank",
        string $sortDir = 'DESC',
        string $searchKey = '',
        ?string &$tcount = null,
        ?string &$tfcount = null
    ): array {

        $records = [];
        $this->db->selectAs('count(*) as count')
            ->from('issued_book')
            ->execute();
        $tot = $this->db->fetch()->count;
        $this->db->select(
            'b.authors name',
            'b.id',
            'isbnNumber',
            'authors',
            'categories',
        )->selectAs(
            'count(ib.bookId) rank'
        )->from('book_detail b')
            ->leftJoin('issued_book ib')
            ->on('b.id = ib.bookId')
            ->where("requestedAt BETWEEN '$sDate' AND '$eDate'");
        if ($searchKey != '') {
            $this->db->where(
                "(b.name LIKE '%$searchKey%'"
                ." OR authors LIKE '%$searchKey%'OR "
                ."isbnNumber LIKE '%$searchKey%'OR "
                ."categories LIKE '%$searchKey%')"
            );
        }
        $this->db->groupBy('b.id');
        $this->db->orderBy($sortby, $sortDir)
            ->limit($limit, $start)
            ->execute();
        while ($row = $this->db->fetch()) {
            $row->impression = round(($row->rank / $tot) * 100, 2) . "%";
            $records[] = $row;
        }
        $this->db->selectAs(
            "COUNT(*) count",
        )->from('book_detail b')
            ->leftJoin('issued_book ib')
            ->on('b.id = ib.bookId')
            ->where("requestedAt BETWEEN '$sDate' AND '$eDate'")
            ->groupBy('b.id')
            ->execute();
        $tcount = $this->db->fetch()->count;
        if ($searchKey != '') {
            $this->db->selectAs(
                "COUNT(*) count",
            )->from('book_detail b')
                ->leftJoin('issued_book ib')
                ->on('b.id = ib.bookId')
                ->where("requestedAt BETWEEN '$sDate' AND '$eDate'");
            $this->db->where(
                "(b.name LIKE '%$searchKey%'"
                ." OR authors LIKE '%$searchKey%'OR "
                ."isbnNumber LIKE '%$searchKey%'OR "
                ."categories LIKE '%$searchKey%')"
            )->groupBy('b.id')
                ->execute();
            $tfcount = $this->db->fetch()->count;
        } else {
            $tfcount = $tcount;
        }
        return $records;
    }

    /**
     * Returns Top Categories List
     *
     * @param string      $sDate     start date
     * @param string|null $eDate     end date
     * @param integer     $start     offset
     * @param integer     $limit     limit value
     * @param string      $sortby    sorting column
     * @param string      $sortDir   sorting direction
     * @param string      $searchKey search key
     * @param string|null $tcount    stores total records count
     * @param string|null $tfcount   stores filtered records  count
     *
     * @return array
     */
    public function getTopCategoryList(
        string $sDate = '0000-00-00',
        ?string $eDate = null,
        int $start = 0,
        int $limit = 10,
        string $sortby = "rank",
        string $sortDir = 'DESC',
        string $searchKey = '',
        ?string &$tcount = null,
        ?string &$tfcount = null
    ): array {

        $records = [];
        $this->db->selectAs('count(*) as count')
            ->from('issued_book')
            ->execute();
        $tot = $this->db->fetch()->count;
        $this->db->select(
            'b.authors name',
            'b.id',
            'isbnNumber',
            'authors',
            'categories',
        )->selectAs(
            'count(ib.bookId) rank'
        )->from('book_detail b')
            ->leftJoin('issued_book ib')
            ->on('b.id = ib.bookId')
            ->where("requestedAt BETWEEN '$sDate' AND '$eDate'");
        if ($searchKey != '') {
            $this->db->where(
                "(b.name LIKE '%$searchKey%'"
                ." OR authors LIKE '%$searchKey%'OR "
                ."isbnNumber LIKE '%$searchKey%'OR "
                ."categories LIKE '%$searchKey%')"
            );
        }
        $this->db->groupBy('b.id');
        $this->db->orderBy($sortby, $sortDir)
            ->limit($limit, $start)
            ->execute();
        while ($row = $this->db->fetch()) {
            $row->impression = round(($row->rank / $tot) * 100, 2) . "%";
            $records[] = $row;
        }
        $this->db->selectAs(
            "COUNT(*) count",
        )->from('book_detail b')
            ->leftJoin('issued_book ib')
            ->on('b.id = ib.bookId')
            ->where("requestedAt BETWEEN '$sDate' AND '$eDate'")
            ->groupBy('b.id')
            ->execute();
        $tcount = $this->db->fetch()->count;
        if ($searchKey != '') {
            $this->db->selectAs(
                "COUNT(*) count",
            )->from('book_detail b')
                ->leftJoin('issued_book ib')
                ->on('b.id = ib.bookId')
                ->where("requestedAt BETWEEN '$sDate' AND '$eDate'");
            $this->db->where(
                "(b.name LIKE '%$searchKey%'"
                ." OR authors LIKE '%$searchKey%'OR "
                ."isbnNumber LIKE '%$searchKey%'OR "
                ."categories LIKE '%$searchKey%')"
            )->groupBy('b.id')
                ->execute();
            $tfcount = $this->db->fetch()->count;
        } else {
            $tfcount = $tcount;
        }
        return $records;
    }

    /**
     * Returns Top Users List
     *
     * @param string      $sDate     start date
     * @param string|null $eDate     end date
     * @param integer     $start     offset
     * @param integer     $limit     limit value
     * @param string      $sortby    sorting column
     * @param string      $sortDir   sorting direction
     * @param string      $searchKey search key
     * @param string|null $tcount    stores total records count
     * @param string|null $tfcount   stores filtered records  count
     *
     * @return array
     */
    public function getTopUserList(
        string $sDate = '0000-00-00',
        ?string $eDate = null,
        int $start = 0,
        int $limit = 10,
        string $sortby = "rank",
        string $sortDir = 'DESC',
        string $searchKey = '',
        ?string &$tcount = null,
        ?string &$tfcount = null
    ): array {

        $records = [];
        $this->db->selectAs('count(*) as count')
            ->from('issued_book')
            ->execute();
        $tot = $this->db->fetch()->count;
        $this->db->select(
            'u.username name',
            'u.id',
            'u.fullName'
        )->selectAs(
            'count(ib.userId) rank'
        )->from('user u')
            ->leftJoin('issued_book ib')
            ->on('u.id = ib.userId')
            ->where("requestedAt BETWEEN '$sDate' AND '$eDate'");
        if ($searchKey != '') {
            $this->db->where(
                "(u.username LIKE '%$searchKey%'"
                ." OR u.fullname LIKE '%$searchKey%')"
            );
        }
        $this->db->groupBy('u.id');
        $this->db->orderBy($sortby, $sortDir)
            ->limit($limit, $start)
            ->execute();
        while ($row = $this->db->fetch()) {
            $row->impression = round(($row->rank / $tot) * 100, 2) . "%";
            $records[] = $row;
        }
        $this->db->selectAs(
            "COUNT(*) count",
        )->from('user u')
            ->leftJoin('issued_book ib')
            ->on('u.id = ib.userId')
            ->where("requestedAt BETWEEN '$sDate' AND '$eDate'")
            ->groupBy('u.id')
            ->execute();
        $tcount = $this->db->fetch()->count;
        if ($searchKey != '') {
            $this->db->selectAs(
                "COUNT(*) count",
            )->from('user u')
                ->leftJoin('issued_book ib')
                ->on('u.id = ib.userId')
                ->where("requestedAt BETWEEN '$sDate' AND '$eDate'");
            $this->db->where(
                "(u.username LIKE '%$searchKey%'"
                ." OR u.fullname LIKE '%$searchKey%')"
            )->groupBy('u.id')
                ->execute();
            $tfcount = $this->db->fetch()->count;
        } else {
            $tfcount = $tcount;
        }
        return $records;
    }

}
