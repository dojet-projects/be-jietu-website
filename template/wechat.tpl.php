
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=0;">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://cdn.bootcss.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body style="margin-top:60px;">

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <form class="form-horizontal col-xs-12" method="post" action="/wechat/image">

          <div class="form-group">
            <label for="" class="col-sm-2 col-xs-12 control-label">时间</label>
            <div class="col-xs-5 col-md-2 col-sm-5">
              <select name="hour" class="form-control">
              <?php for ($i = 0; $i < 24; $i++) : ?>
                <option value="<?=sprintf("%02d", $i)?>" <?=$i == date("H") ? 'selected' : ''?>><?=sprintf("%02d", $i)?></option>
              <?php endfor; ?>
              </select>
            </div>
            <div class="col-xs-5 col-md-2 col-sm-5">
              <select name="minute" class="form-control">
              <?php for ($i = 0; $i < 60; $i++) : ?>
                <option value="<?=sprintf("%02d", $i)?>" <?=$i == date("i") ? 'selected' : ''?>><?=sprintf("%02d", $i)?></option>
              <?php endfor; ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="" class="col-sm-2 col-xs-12 control-label">电量</label>
            <div class="col-xs-5 col-md-2 col-sm-5">
              <select name="battery" class="form-control">
              <?php $battery = (date("YmdHi") + date("s")) % 100; ?>
              <?php for ($i = 1; $i <= 100; $i++) : ?>
                <option value="<?=sprintf("%d", $i)?>" <?=$i == $battery ? 'selected' : ''?>><?=sprintf("%d", $i)?>%</option>
              <?php endfor; ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="" class="col-sm-2 col-xs-12 control-label">运营商</label>
            <div class="col-xs-5 col-md-2 col-sm-5">
              <select name="carrier" class="form-control">
              <?php foreach (array('中国移动', '中国联通', '中国电信') as $carrier) : ?>
                <option value="<?=$carrier?>"><?=$carrier?></option>
              <?php endforeach; ?>
              </select>
            </div>
          </div>

          <hr />
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">生成图片</button>
            </div>
          </div>

        </form>

      </div>
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  </body>
</html>
