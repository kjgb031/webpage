var slider_img = document.querySelector('.slider-img');
var images1 = ['Baybayin.png', 'Gold.png', 'Jar.png', 'Tabon.png', 'Textile.png'];
var images2 = ['Builders.png', 'Ermita.png', 'Market.png', 'Parisian.png', 'Spolarium.png'];
var images3 = ['Akbil.png', 'Coffin.png', 'Lolong.png', 'Pouches.png', 'Tree.png'];

document.addEventListener("DOMContentLoaded", function() {
    const imgContainers = document.querySelectorAll('.img-con');

    imgContainers.forEach(function(container) {
        const img = container.querySelector('img');
        
        container.addEventListener('mouseover', function() {
            img.style.transform = 'scale(1.1)';
        });

        container.addEventListener('mouseout', function() {
            img.style.transform = 'scale(1)';
        });
    });
});

function aboutUs() {
	window.location.href = "/AboutUs.html";
}

function btnHomepage() {
    	window.location.href = "/mainPage.html";
}
/*ANTHROPOLOGY CAROUSEL*/
var a = 0;

function back1() {
	if(a <= 0) a = images1.length;	
	a--;
	return setImg1();			 
}

function next1() {
	if(a >= images1.length-1) a = -1;
	a++;
	return setImg1();			 
}

function setImg1() {
	return slider_img.setAttribute('src', "anthroimg/"+images1[a]);
	
}

/*FINE ARTS CAROUSEL*/

var b = 0;

function back2() {
	if(b <= 0) b = images2.length;	
	b--;
	return setImg2();			 
}

function next2() {
	if(b >= images2.length-1) b = -1;
	b++;
	return setImg2();			 
}

function setImg2() {
	return slider_img.setAttribute('src', "artsimg/"+images2[b]);
	
}

/*NATURAL HISTORY CAROUSEL*/

var c = 0;

function back3() {
	if(c <= 0) c = images3.length;	
	c--;
	return setImg3();			 
}

function next3() {
	if(c >= images3.length-1) c = -1;
	c++;
	return setImg3();			 
}

function setImg3() {
	return slider_img.setAttribute('src', "naturalhistoimg/"+images3[c]);
	
}

  // get request to /backend.php
        //initial xml data
        document.addEventListener("DOMContentLoaded", function() {
            fetch('Museum.php')
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                });
        });


        // use the search parameter to filter the data

        const searchbar = document.getElementById('search');

        searchbar.addEventListener('input', function() {
            fetch(`Museum.php?search=${searchbar.value}`)
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                });
        });
