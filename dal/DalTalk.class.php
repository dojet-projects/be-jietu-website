<?php
/**
 * dal
 *
 * DAL code
 * Filename: DalTalk.class.php
 *
 * @author liyan
 * @since 2015 8 26
 */
class DalTalk extends MysqlDal {

    protected static function defaultDB() {
        return DBDEMO;
    }

    public static function getTalk($num, $fromid) {
        $sql = "SELECT *
                FROM talk
                WHERE tid>$fromid
                ORDER BY tid
                LIMIT $num";
        return self::rs2keyarray($sql, 'tid');
    }

    public static function addTalk($words) {
        $arrIns = array(
            'words' => $words,
            );
        return self::doInsert('talk', $arrIns);
    }

}
