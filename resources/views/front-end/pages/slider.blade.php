<div id="slider">
    <!-- render slider -->
</div>
<script>

$(document).ready((e)=>{
    const slider = async () => {
        const response = await fetch('http://kanestore.com/api/slider', {
            method: 'GET',
            dataType: 'json',
        });
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return await response.json(); 
    }



    const getSlider = async () => {
        let data = [];
        try{
            data = await slider();
        }catch (error){
            console.log(error);
        }
        let html = '<div class="owl-carousel owl-theme">';
            $.each(data.slider, (index,value)=> {
                html+=`
                <div class="item"> 
                    <a href="">
                        <img src="assets/img/upload/slider/${value.image}" alt="${value.name}">
                    </a>
                </div>
                `;
            })
            html+= `</div>`; 
        return $('#slider').html(html);
    }

    getSlider();


    const owlSlider = async () => {
        let data = [];
        try {
            data = await getSlider();
        } catch (error) {
            console.log(error);
        }
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            responsiveClass:true,
            autoplay:true,
            autoplayTimeout:3000,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                600:{
                    items:2,
                    nav:false
                },
                1000:{
                    items:2,
                    nav:true
                }
            }
        })
    } 
    owlSlider();
})
</script>
