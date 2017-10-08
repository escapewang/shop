<?php 
clearstatcache();

function search($perPage = 5)
    {
        /*************** 搜索 ******************/
        $where = array();  // 空的where条件
        // 商品名称
        $gn = I('get.gn');
        if($gn)
            $where['goods_name'] = array('like', "%$gn%");  // WHERE goods_name LIKE '%$gn%'
        // 价格
        $fp = I('get.fp');
        $tp = I('get.tp');
        if($fp && $tp)
            $where['shop_price'] = array('between', array($fp, $tp)); // WHERE shop_price BETWEEN $fp AND $tp
        elseif ($fp)
            $where['shop_price'] = array('egt', $fp);   // WHERE shop_price >= $fp
        elseif ($tp)
            $where['shop_price'] = array('elt', $tp);   // WHERE shop_price <= $fp
        // 是否上架
        $ios = I('get.ios');
        if($ios)
            $where['is_on_sale'] = array('eq', $ios);  // WHERE is_on_sale = $ios
        // 添加时间
        $fa = I('get.fa');
        $ta = I('get.ta');
        if($fa && $ta)
            $where['addtime'] = array('between', array($fa, $ta)); // WHERE shop_price BETWEEN $fp AND $tp
        elseif ($fa)
            $where['addtime'] = array('egt', $fa);   // WHERE shop_price >= $fp
        elseif ($ta)
            $where['addtime'] = array('elt', $ta);   // WHERE shop_price <= $fp
        
        
        /*************** 翻页 ****************/
        // 取出总的记录数
        $count = $this->where($where)->count();
        // 生成翻页类的对象
        $pageObj = new \Think\Page($count, $perPage);
        // 设置样式
        $pageObj->setConfig('next', '下一页');
        $pageObj->setConfig('prev', '上一页');
        // 生成页面下面显示的上一页、下一页的字符串
        $pageString = $pageObj->show();
        
        /***************** 排序 *****************/
        $orderby = 'id';      // 默认的排序字段 
        $orderway = 'desc';   // 默认的排序方式
        $odby = I('get.odby');
        if($odby)
        {
            if($odby == 'id_asc')
                $orderway = 'asc';
            elseif ($odby == 'price_desc')
                $orderby = 'shop_price';
            elseif ($odby == 'price_asc')
            {
                $orderby = 'shop_price';
                $orderway = 'asc';
            }
        }
        
        /************** 取某一页的数据 ***************/
        $data = $this->order("$orderby $orderway")                    // 排序
        ->where($where)                                               // 搜索
        ->limit($pageObj->firstRow.','.$pageObj->listRows)            // 翻页
        ->select();
        
        /************** 返回数据 ******************/
        return array(
            'data' => $data,  // 数据
            'page' => $pageString,  // 翻页字符串
        );
    }






 ?>