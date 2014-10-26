<?php
if(!defined('IN_TEMPLATE'))
{
  exit('Access denied');
}
?>
<script>
$(document).ready(function()
{
    $("#board").submit(function(e)
    {
        $("#display").html("SUBMIT...");
        e.preventDefault();
        $.post("rank.php",
            $("#board").serialize(),
            function(res){
                if(res.status === 'error')
                {
                   $("#display").html(res.data);
                }
                else if(res.status === 'SUCC')
                {
                    $("#display").html("YES");
                    setTimeout(function(){location.href="rank.php?mod=cbedit&id="+res.data;}, 500);
                }
        },"json");
        return true;
    });
})
</script>
<div class="container">
    <div class="row">
        <div class="page-header">
          <h1>編輯記分板 <small><?=htmlspecialchars($_E['template']['title'])?>
          <?php if($_E['template']['form']['id']):?>
          <span class="pointer glyphicon glyphicon-ok" onclick="location.href='rank.php?mod=commonboard&id=<?=$_E['template']['form']['id']?>'" title="回到記分板"></span>
          <?php endif;?>
          </small></h1>
      </div>
    </div>
    <div class="row">
    <form class="form-horizontal" role="form" id="board" >
            <input type="hidden" name="mod" value="edit">
            <input type="hidden" name="page" value="cbedit">
            <input type="hidden" name="id" value="<?=$_E['template']['form']['id']?>">
            <div class="form-group">
                <label class="col-md-2 control-label">名稱</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="name" placeholder="Board Name" value="<?=$_E['template']['form']['name']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">登記ID</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="userlist" placeholder="Account ID" value="<?=$_E['template']['form']['userlist']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">題目列表</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="problems" placeholder="Problems" value="<?=$_E['template']['form']['problems']?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-md-5">
                    <button type="submit" class="btn btn-success text-right">送出</button>
                    <span id="display"></span>
                </div>
            </div>
        </form>
    </div>
    <br>
     <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table class="table  table-bordered">
                <thead>
                    <tr>
                        <th>插件名稱</th>
                        <th>作者</th>
                        <th>版本</th>
                        <th>描述</th>
                        <th>格式</th>
                    </tr>
                </thead>
                </tbody>
                    <?php foreach($_E['template']['rank_site'] as $site => $data){?>
                    <tr>
                        <td><?=$data['name']?></td>
                        <td><?=$data['author']?></td>
                        <td><?=$data['version']?></td>
                        <td><?=$data['desc']?></td>
                        <td><?=$data['format']?></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>