<?php

namespace App\Models;

use App\Helper\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int $id
 * @property int $name
 * @property int $length 文件总大小
 * @property int $hot 热度
 * php artisan scout:import "App\Models\Bt"
 *
 */
class Bt extends Model
{
    use HasFactory;

    protected $table = 'bt';
    use \Laravel\Scout\Searchable;


    public $timestamps = false;
    public function tag()
    {
        return $this->hasOne(BtTags::class,'bid','id');
    }

    /**
     * 获取与模型关联的索引的名称。
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'ttt_index';
    }


    /**
     * 获取模型的可索引的数据。
     *
     * @return array
     */
    public function toSearchableArray()
    {

        return [
            'name' => $this->name,
            'size' => $this->length,
            'size2' => File::sizecount($this->length) ,
            'hot' => $this->hot,
            'id'   => $this->id
        ];
    }


    /**
     * 获取用于索引模型的值
     *
     * @return mixed
     */
    public function getScoutKey()
    {
        return $this->id;
    }

    /**
     * 获取用于索引模型的键名
     *
     * @return mixed
     */
    public function getScoutKeyName()
    {
        return 'id';
    }

    /**
     * 确定模型是否可搜索
     *
     * @return bool
     */
    public function shouldBeSearchable()
    {
        return true;
    }


}
