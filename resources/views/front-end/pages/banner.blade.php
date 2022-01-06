<div id="banner">
    <!-- render banner -->
</div>
<script>

$(document).ready((e)=>{
    const banner = async () => {
        const response = await fetch('/banner', {
            method: 'GET',
            dataType: 'json',
        });
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return await response.json(); 
    }



    const getBanner = async () => {
        let data = [];
        try{
            data = await banner();
        }catch (error){
            console.log(error);
        }
        let html = '<div class="owl-carousel owl-theme">';
            $.each(data.banner, (index,value)=> {
                html+=`
                <div class="item"> 
                    <a href="">
                        <img src="../assets/img/upload/banner/${value.image}" alt="${value.name}">
                    </a>
                </div>
                `;
            })
            html+= `</div>`; 
        return $('#banner').html(html);
    }

    const sliderBanner = async () => {
        let data = [];
        try {
            data = await getBanner();
        } catch (error) {
            console.log(error);
        }
        slider();
    } 
    sliderBanner();
})
</script>