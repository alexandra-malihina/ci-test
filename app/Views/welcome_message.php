
<canvas id="canvas_user"  style="display:none;position:fixed; top:0px; left:0px;height:100vh;width:100vw; z-index:-5">
</canvas>
<canvas id="canvas_admin"  style="display:none;position:fixed; top:0px; left:0px;height:100vh;width:100vw; z-index:-5">
</canvas>
	
	<div id='start' table="fff" style="width:100vw;height:100vh; z-index:1000; background-color:white; padding:25%;font-size:48px; position:fixed; top:0px;left:0px" onClick="document.getElementById('start').style.display = 'none';">
		Just CLICK
	</div>
	<div id="content" class="flex-lg-row flex-sm-column body-fill p-15">
		<div id="panel_user" class="panel p-15 cursor-pointer opacity-hover" onmouseenter="mouse_enter_user()"> 
			<p>
				<? echo lang('home.panel_user'); ?>
			</p>
			<div class="button cursor-pointer opacity-hover" onClick="formUser()">
				<? echo lang('home.panel_user_button'); ?>
			</div>
		</div>
		<p class="big-mf-text p-15"> 
			<? echo lang('home.or'); ?>
		</p>
		<div id="panel_admin" class="panel p-15 cursor-pointer opacity-hover" onmouseenter="mouse_enter_admin()">
			<p>		
				<? echo lang('home.panel_admin'); ?>		
			</p>
			<div class="button cursor-pointer opacity-hover" onClick="formAdmin()" table="users">
				<? echo lang('home.panel_admin_button'); ?>
			</div>
		</div>
	</div>
	<audio	id="aud" loop>
  		Ваш браузер не поддерживает элемент <code>audio</code>.
	</audio>
	<script>
		function formUser(){
			form.setFormWrapF("users",['login','password'],[
				{
					type:'close-wrap',

					title:{
						en:'Close',
						ru:'Назад'
					}
				},
				{
					type:'check',
					title:{
						en:'LOG IN',
						ru:'ВОЙТИ'
					}
				}
			]);
		}
		function formAdmin(){
			// document.getElementById('modal_wrap').style.display = "flex";
			// form.cc('formADmin');
			// setFormWrapF:function(tableName,fieldsA,footer_buttons,style_class='')
			form.setFormWrapF("users",['login','password'],[
				{
					type:'close-wrap',
					title:{
						en:'Close',
						ru:'Назад'
					}
				},
				{
					type:'check',
					url:'users/admin'
					title:{
						en:'LOG IN',
						ru:'ВОЙТИ'
					}
				}
			],'dark');
			
		}
		var choosen='none';
		var reid;
		var audio_src={
			'user':'<? echo base_url();?>/src/audio/happy.mp3',
			'admin':'<? echo base_url();?>/src/audio/evil.mp3'
		}
		var audio = document.getElementById('aud');

		function mouse_enter_user(){   

			if(choosen!='user')
			{
				document.getElementById('panel_admin').classList.remove('dark');
				document.getElementById('panel_user').classList.remove('dark');
				audio.pause();
				audio.src=audio_src['user'];
				audio.play();

				document.getElementById('canvas_admin').style.display = "none";
				choosen='user';
				if (reid){
					cancelAnimationFrame(reid);
				}
				particleInit();
				function particleInit() {
					width = window.innerWidth;
					height = window.innerHeight;
					target = {
						x: 0,
						y: height
					};

					canvas = document.getElementById('canvas_user');
					canvas.style.display='block';
					canvas.width = width;
					canvas.height = height;
					ctx = canvas.getContext('2d');
					ctx.clearRect(0, 0, width, height);
					circles = [];
					console.log(circles.length);
					for( var x = 0; x < width*0.25; x++ ) {
						var c = new particleCircle();
						circles.push(c);
					}
					particleAnimate();
				}

				function particleResize() {
				width = window.innerWidth;
				height = window.innerHeight;
				canvas.width = width;
				canvas.height = height;
				}

				function particleAnimate() {
					ctx.clearRect(0, 0, width, height);
					for( var i in circles ) {
						circles[i].draw();
					}
					reid=requestAnimationFrame(particleAnimate);
				}

				function particleCircle() {
				var _this = this;

				(function() {
					_this.pos = {};
					init();
				})();

				function init() {
					_this.pos.x = Math.random() * width;
					_this.pos.y = height + Math.random() * 100;
					_this.alpha = 0.2 + Math.random() * 0.4;
					_this.scale = 0.4 + Math.random();
					_this.velocity = Math.random() * 1.6;
				}

				_this.draw = function() {
					if ( _this.alpha <= 0 ) {
					init();
					}
					_this.pos.y -= _this.velocity;
					_this.alpha -= 0.0005;
					ctx.beginPath();
					ctx.arc(_this.pos.x, _this.pos.y, _this.scale * 10, 0, 2 * Math.PI, false);
					ctx.fillStyle = 'rgba('+Math.floor(Math.random()*255)+','+Math.floor(Math.random()*255)+','+Math.floor(Math.random()*255)+',' +  _this.alpha + ')';
					ctx.fill();
				};
			}
			
		}
	}
			


function mouse_enter_admin(){  
	if(choosen!='admin')
	{
		document.getElementById('panel_admin').classList.add('dark');
		document.getElementById('panel_user').classList.add('dark');
		audio.pause();
				audio.src=audio_src['admin'];
				audio.play();
		document.getElementById('canvas_user').style.display = "none";
		document.getElementById('canvas_admin').style.display = "block";
		choosen='admin';
		if (reid){
			cancelAnimationFrame(reid);
		}
		var Obj = {
	circle: new Array(40),
	radius: 250,
	noise: 20,
	speed: 0.3,
	size: 400,
	
	//color a = background color; color b = object color 
	color: {
		a: 'hsla(280, 95%, 5%, 1)',
		b: 'hsla(255, 255%, 255%, .8)'
	},
	//X & Y positions
	X: function(x) {
		return Obj.c.width / 2 + x;
	},

	Y: function(y) {
		return Obj.c.height / 2 - y;
	},
	//behavior
	Circle: function(i) {
		this.r = Obj.radius - i * Obj.radius / Obj.circle.length;
		this.e = i % 2 ? true : false;
		this.max = Math.random() * Obj.noise;
		this.min = -Math.random() * Obj.noise;
		this.val = Math.random() * (this.max - this.min) + this.min;
	},
	//clearing   
	Clear: function() {
		Obj.$.fillStyle = Obj.color.a;
		Obj.$.fillRect(0, 0, Obj.c.width, Obj.c.height);
	},
	//shape changing  
	Change: function(C) {
		for (var i = 0; i < Obj.size; i++) {
		var a = i * Math.PI * 2 / Obj.size;
		var x = Math.cos(a) * (C.r - C.val * Math.cos(i / 4));
		var y = Math.sin(a) * (C.r - C.val * Math.cos(i / 4));
		Obj.$.fillStyle = Obj.color.b;
		Obj.$.fillRect(Obj.X(x), Obj.Y(y), 1, 1);
		}
		Obj.Check(C);
	},
	//noise level checks
	Check: function(C) {
		C.val = C.e ? C.val + Obj.speed : C.val - Obj.speed;
		if (C.val < C.min) {
		C.e = true;
		C.max = Math.random() * Obj.noise;
		}
		if (C.val > C.max) {
		C.e = false;
		C.min = -Math.random() * Obj.noise;
		}
	},
	//update object
	Update: function() {
		Obj.Clear();
		for (var i = 0; i < Obj.circle.length; i++) {
		Obj.Change(Obj.circle[i]);
		}
	},
	//draw object
	Draw: function() {
		Obj.Update();
		reid=window.requestAnimationFrame(Obj.Draw, Obj.c);
	},
	//set circles
	Set: function() {
		for (var i = 0; i < Obj.circle.length; i++) {
		Obj.circle[i] = new Obj.Circle(i);
		}
	},

	//size control
	Size: function() {
		Obj.c.width = window.innerWidth;
		Obj.c.height = window.innerHeight;
	},
	//get canvas
	Run: function() {
		Obj.c = document.getElementById('canvas_admin');
		Obj.$ = Obj.c.getContext('2d');

	},
	//start   
	Init: function() {
		Obj.Run();
		Obj.Size();
		Obj.Set();
		Obj.Draw();
	}

	};
	Obj.Init();
	console.log(Obj);

	}
	  
  }
    </script>
