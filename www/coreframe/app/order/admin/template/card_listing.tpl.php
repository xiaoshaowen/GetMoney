<?php defined('IN_WZ') or exit('No direct script access allowed');?>
<?php
    include $this->template('header','core');
?>
<body>
<section class="wrapper">
<!-- page start-->
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <?php echo $this->menu($GLOBALS['_menuid']);?>
            <header class="panel-heading">
                <form class="form-inline" role="form">
                    <input type="hidden" name="m" value="<?php echo M;?>" />
                    <input type="hidden" name="f" value="<?php echo F;?>" />
                    <input type="hidden" name="v" value="<?php echo V;?>" />
                    <input type="hidden" name="_su" value="<?php echo _SU;?>" />
                    <input type="hidden" name="_menuid" value="<?php echo $GLOBALS['_menuid'];?>" />
                    <input type="hidden" name="search" />
                    <div class="input-group">
                        <select name="keytype" class="form-control">
                            <option value="0" <?php if($keytype==0) echo 'selected';?>>预约卡号</option>
                            <option value="1" <?php if($keytype==1) echo 'selected';?>>使用人</option>
                        </select>
                    </div>
                    <input type="text" name="keywords" class="usernamekey" value="<?php echo $keywords?>"/>

                    <button type="submit" class="btn btn-info btn-sm">搜索</button>
                </form>
            </header>
            <form action="?m=affiche&f=index&v=sort<?php echo $this->su();?>" name="myform" method="post">
            <div class="panel-body" id="panel-bodys">
                <table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th class="hidden-phone tablehead">预约卡号</th>
                        <th class="tablehead">绑定套餐名</th>
                        <th class="tablehead">生成时间</th>
                        <th class="tablehead">过期时间</th>
                        <th class="tablehead">使用人</th>
                        <th class="tablehead">状态</th>
                        <th class="tablehead">管理操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($result AS $r) {
                        $mr = $this->db->get_one('member',array('uid'=>$r['uid']));
                        $tr = $this->db->get_one('tuangou',array('id'=>$r['id']));
                        ?>
                        <tr title="生成人：<?php echo $r['adminname'];?> &#10;备注：<?php echo $r['admin_note'];?>">
                            <td><?php echo $r['card_no'];?></td>
                            <td><?php echo $tr['title'];?></td>
                            <td><?php echo time_format($r['addtime']);?></td>
                            <td><?php echo date('Y-m-d',$r['endtime']);?></td>
                            <td><?php echo $mr['username'];?></td>
                            <td><?php echo $status_arr[$r['status']];?></td>
                            <td>
                                <a href="?m=order&f=card&v=send&cardid=<?php echo $r['cardid'];?><?php echo $this->su();?>" class="btn btn-primary btn-xs">发送</a>
                                <a href="?m=order&f=card&v=history&cardid=<?php echo $r['cardid'];?><?php echo $this->su();?>" class="btn btn-default btn-xs">发送记录</a>

                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="pull-right">
                                <ul class="pagination pagination-sm mr0">
                                    <?php echo $pages;?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </section>
        </form>
    </div>
</div>
<!-- page end-->
</section>
<script type="text/javascript">
    function send_goods(id,username){
        top.openiframe('index.php?m=order&f=index&v=send_goods&orderid='+id+'<?php echo $this->su();?>', 'edit', '处理"'+username+'"的订单', 660, 450);
    }
    function view(id,username){
        top.openiframe('index.php?m=order&f=index&v=view&orderid='+id+'<?php echo $this->su();?>', 'view', '查看"'+username+'"的订单', 660, 260);
    }

    </script>
<script src="<?php echo R;?>js/bootstrap.min.js"></script>
<script src="<?php echo R;?>js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/pxgrids-scripts.js"></script>
</body>
</html>