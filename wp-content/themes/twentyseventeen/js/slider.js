var slider = {
	slides:['./image/ukladka.jpg','./image/kosa.jpg','./image/kreativ.jpg','./image/osmo.jpg'],
	frame:0, // текущий кадр для отбражения - индекс картинки из массива
	set: function(image) { // установка нужного фона слайдеру
		document.getElementById("scr").style.backgroundImage = "url("+image+")";
	},
	init: function() { // запуск слайдера с картинкой с нулевым индексом
		this.set(this.slides[this.frame]);
	},
	left: function() { // крутим на один кадр влево
		this.frame--;
		if(this.frame < 0) this.frame = this.slides.length-1;
		this.set(this.slides[this.frame]);
	},
	right: function() { // крутим на один кадр вправо
		this.frame++;
		if(this.frame == this.slides.length) this.frame = 0;
		this.set(this.slides[this.frame]);		
	}
};
window.onload = function() { // запуск слайдера после загрузки документа
	slider.init();
	setInterval(function() { // ставим пятисекундный интервал для перелистывания картинок
		slider.right();
	},5000);
};