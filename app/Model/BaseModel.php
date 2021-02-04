<?php
declare(strict_types=1);

namespace App\Model;

use Hyperf\Database\Model\SoftDeletes;
use Hyperf\DbConnection\Db;

/**
 * 基础模型
 * Class BaseModel
 * @package App\Model
 */
class BaseModel extends \Hyperf\Database\Model\Model
{
    use SoftDeletes;

    /**
     * 批量添加
     * @param string $tableName 数据表名
     * @param array $info 插入的数据
     * @return bool
     * @author kert
     */
    public function batchAll(string $tableName, array $info): bool
    {
        $timeArray = [
            'create_time' => time(),
            'update_time' => time(),
        ];
        array_walk($info, function (&$value, $key, $timeArray) {
            $value = array_merge($value, $timeArray);
        }, $timeArray);
        return DB::table($tableName)->insert($info);
    }


    /**
     * 批量更新
     * @param string $tableName 数据表名
     * @param array $info 更新的数据
     * @return int|string
     * @author kert
     */
    public function batchUpdate(string $tableName, array $info)
    {
        $tableName = env('DB_PREFIX') . $tableName;
        try {
            if (count($info) > 0) {
                $firstRow        = current($info);
                $updateColumn    = array_keys($firstRow);
                $referenceColumn = isset($firstRow['id']) ? 'id' : current($updateColumn);
                unset($updateColumn[0]);
                $updateSql = "UPDATE " . $tableName . " SET ";
                $sets      = [];
                $bindings  = [];
                foreach ($updateColumn as $uColumn) {
                    $setSql = "`" . $uColumn . "` = CASE ";
                    foreach ($info as $data) {
                        $setSql     .= "WHEN `" . $referenceColumn . "` = ? THEN ? ";
                        $bindings[] = $data[$referenceColumn];
                        $bindings[] = $data[$uColumn];
                    }
                    $setSql .= "ELSE `" . $uColumn . "` END ";
                    $sets[] = $setSql;
                }
                $updateSql .= implode(', ', $sets);
                $whereIn   = collect($info)->pluck($referenceColumn)->values()->all();
                $bindings  = array_merge($bindings, $whereIn);
                $whereIn   = rtrim(str_repeat('?,', count($whereIn)), ',');
                $updateSql = rtrim($updateSql, ", ") . " WHERE `" . $referenceColumn . "` IN (" . $whereIn . ")";
                var_dump($updateSql);
                var_dump(DB::update($updateSql, $bindings));
//                return DB::update($updateSql, $bindings);
            }
            return 0;
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            return $e->getMessage();
        }
    }
}