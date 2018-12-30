<?php
namespace app\Helpers\Util;

/**
 +------------------------------------------------
 * 通用的树型类
 * 请使用的朋友注意 id, name, parentid 这三个下标, id的值与数组下标必须吻合 
 +------------------------------------------------
 */ 
class Tree
{
	 
	var $arr = array();
	
	/**
	 * +------------------------------------------------
	 * 生成树型结构所需修饰符号，可以换成图片
	 * +------------------------------------------------
	 */
	var $icon = array('│','├─','└─' );
    var $ret = '';
    var $id;
    var $fid;
    var $html;
    var $level;

    /**
     * 构造函数，初始化类
     */
    public function __construct($arr = array(),$id = 'id',$fid = 'parent_id',$html = 'html',$level = 'level') {
        $this->arr = $arr;
        $this->ret = '';
        $this->id = $id;
        $this->fid = $fid;
        $this->html = $html;
        $this->level = $level;
        return is_array ( $arr );
    }
	
	/**
	 * 得到子级数组
	 * @param  int
	 * @return array
	 */
    public function get_child($myid, $level) {
        $a = $newarr = array ();
        $num = 0;
		if (is_array ( $this->arr )) {

			foreach ( $this->arr as $id => $a ) {
                if ($a [$this->fid] == $myid){

                    if(!isset($a[$this->level])){
                        $a [$this->level] = $level;
                    }

                    if(!isset($a['child_num'])){
                        $a ['child_num'] = 0;
                    }

                    $newarr [$id] = $a;
                    $num++;
                }
			}
		}
		return $newarr ? $newarr : false;
	}

    /**
     * 得到当前位置数组
     * @param int
     * @return array
     */
    public function get_pos($myid,&$newarr)
    {
        $a = array();
        if(!isset($this->arr[$myid])) return false;
        $newarr[] = $this->arr[$myid];
        $pid = $this->arr[$myid][$this->fid];
        if(isset($this->arr[$pid]))
        {
            $this->get_pos($pid,$newarr);
        }
        if(is_array($newarr))
        {
            krsort($newarr);
            foreach($newarr as $v)
            {
                $a[$v[$this->id]] = $v;
            }
        }
        return $a;
    }

/**
	 * +------------------------------------------------
	 * 格式化数组
	 * +------------------------------------------------
	 */
    public function getArray($myid = 0, $sid = 0, $adds = '',$level = 1) {
		$number = 1;
		$child = $this->get_child ( $myid ,$level);

		if (is_array ( $child )) {
			$total = count ( $child );

			foreach ( $child as $id => $a ) {

			    if(!isset($a[$this->html])){
                    $a [$this->html] = '';
                }

				$j = $k = '';
				if ($number == $total) {
					$j .= $this->icon [2];
				} else {
					$j .= $this->icon [1];
					$k = $adds ? $this->icon [0] : '';
				}
				$spacer = $adds ? $adds . $j : '';
				@extract ( $a );

				$a [$this->html] = $spacer . ' ' . $a [$this->html];
				$this->ret [$a [$this->id]] = $a;

                if(isset($this->ret [$a [$this->fid]])){
                    $temp = $this->ret [$a [$this->fid]];
                    $temp['child_num'] = $total;
                    $this->ret [$a [$this->fid]] = $temp;
                }


				$fd = $adds . $k . '&nbsp;&nbsp;&nbsp;&nbsp;';
                $level++;

				$this->getArray ( $a [$this->id], $sid, $fd, $level);



				$number ++;
			}
		}
		
		return $this->ret;
	}
}
 
//
// $list = array(
//        1 => array('id'=>'1','parentid'=>0,'name'=>'一级栏目一'),
//        2 => array('id'=>'2','parentid'=>0,'name'=>'一级栏目二'),
//        3 => array('id'=>'3','parentid'=>1,'name'=>'二级栏目一'),
//        4 => array('id'=>'4','parentid'=>1,'name'=>'二级栏目二'),
//        5 => array('id'=>'5','parentid'=>2,'name'=>'二级栏目三'),
//        6 => array('id'=>'6','parentid'=>3,'name'=>'三级栏目一'),
//        7 => array('id'=>'7','parentid'=>3,'name'=>'三级栏目二')
// );
//$tree = new Tree($list);
//$categorys = $tree->getArray();
//print_r($categorys);