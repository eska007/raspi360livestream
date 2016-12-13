<!doctype html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <title> On-Air Alive Nature </title>
    <style>
      #jb-container {
        width: 100%<!--940px;-->
        margin: 0px auto;
        padding: 20px;
        border: 1px solid #bcbcbc;
      }
      #jb-header {
        padding: 20px;
        margin-bottom: 20px;
      }
      #jb-content {
        padding: 20px;
        margin-bottom: 20px;
      }
      #jb-footer {
        clear: both;
        padding: 20px;
      }
	  .button{
		background-color: #008CBA; /* BLUE */
		border: none;
		color: white;
		padding: 15px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		width: 20%;
		border-radius: 8px;
<!--
		margin 4px 2px;
		cursor: pointer;
		border: 3px solid white;
-->
		}
		#alerts{
			margin: auto;
			width: 100%;
			text-align: center;
			font-size: 16px;
		}
		#btn_list{
			margin: auto;
			width: 100%;
			text-align: center;
		}
		#cam_container{
			margin: auto;
			width: 100%;
		}
		div#cam_container
		{
			/* -webkit-transform:rotate(180deg); */ /* Chrome, Safari, Opera */
			/* transform:rotate(180deg); */ /* Standard syntax */
		}
    </style>
	<script src="jquery-3.1.1.js"></script>
	<script type ="text/javascript">
		$(document).ready(function(){
			$('#cam_container').hide();

			$('#record').click(function(){
				$('#response').text("Recording Started. Please wait...");
				$.ajax({
					type: 'Post',
					url: 'record_script.php',
					success: function(data1){
						$('#cam_container').hide();
						$('#response').text(data1);
					}
				});
			});

			$('#streaming').click(function(){
				$('#response').text("Starting camera. Please wait..");
				/**window.location = "http://xxx.xxx.xx.xxx:xxxxx/?action=stream"**/
				$.ajax({
					type: 'Post',
					url: 'stream_script.php',
					success: function(data2){
						$('#cam_container').show();
						$('#cam_stream').attr('src', 'http://xxx.xxx.xx.xxx:xxxxx/?action=stream');
						$('#response').text(data2);
					}
				});
			});
			$('#stop').click(function(){
				$('#response').text("Stopping streaming. please wait..");
				$.ajax({
					type: 'Post',
					url: 'stop_script.php',
					success: function(data3){
						$('#cam_container').hide();
						$('#response').text(data3);
					}
				});
			});
		});
        </script>
  </head>
  <body>
    <div id="jb-container">
		<div id="jb-header">
			<div id="btn_list">
			<button id="record" class="button" type="button">Recording</button>
			<button id="streaming" class="button" type="button">Streaming</button>
			<button id="stop" class="button" type="button">Stop</button>
		</div>
      </div>
      <div id="jb-content">
		<div id="cam_container" align="center">
			<img id="cam_stream" src="stream" width "100%" height="100%"/>
		</div>
      </div>

      <div id="jb-footer">
		<div id="alerts" align="center">
			<h1 id="response"></h1>
		</div>
      </div>
    </div>
  </body>
</html>
