<?php
declare(strict_types=1);

namespace App\Model\Db;


use Hyperf\DbConnection\Db;

/**
 * 数据查询
 * Class Common
 * @package App\Model\Db
 */
class CommonDb
{
    /**
     * 指定内容查询
     * @param string $tableName 查询数据表
     * @param array $searchWhere 查询条件[['id','=',1]] or [['id','>', 1]] or [['name', 'like', '']]
     * @param array $searchFields 查询字段
     * @return array
     * @author ert
     */
    public static function selectByWhere(string $tableName, array $searchWhere, array $searchFields = ['*']): array
    {
        $searchFieldStr = '';
        foreach ($searchFields as $value) {
            $searchFieldStr .= " `{$value}` " . ',';
        }
        $searchFieldStr = substr($searchFieldStr, 0, strlen($searchFieldStr) - 1);

        // TODO 优化查询条件
        $where = '';
        foreach ($searchWhere as $value) {
            $where .= " `$value[0]` = $value[2] and ";
        }
        $where .= ' 1 = 1 ';

        $tableName = config('databases.default.prefix') . $tableName;

        $sql = "select {$searchFieldStr} from {$tableName} where {$where}";
        var_dump($sql);
        $items = Db::select("$sql");

        $resultArray = [];
        foreach ($items as $key => $value) {
            foreach ($searchFields as $val) {
                $resultArray[$key][$val] = $value->$val;
            }
        }
        var_dump($resultArray);
        return $resultArray;
    }
}