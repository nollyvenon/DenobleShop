<!doctype html>
<html><head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style type="text/css">
.marquee {
  width: 300px;
  height: 300px;
  overflow: hidden;
  border: 1px solid #ccc;
  background: #ccc;
}
</style>
</head>

<body>
<div class="marquee" data-duplicated='true' data-direction='up'>jQuery marquee is the best marquee plugin in the world</div></body>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script type='text/javascript' src='//cdn.jsdelivr.net/jquery.marquee/1.4.0/jquery.marquee.min.js'></script>
<script>
$('.marquee').marquee({
  direction: 'top'
});</script>
</html>