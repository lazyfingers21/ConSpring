var color = 0;
if(sole.element("particle")){
    setInterval(bgcolor,100)    
}
function bgcolor(){
    var particle = sole.element("particle");
    particle.style = "background: hsl("+color+", 100%, 8%)";
    if(color == 357){
        color = 0;
    }else{
        color++;
    }
}
if(sole.element("particle")){
    window.onload = function() {
        Particles.init({
            selector: '.particle',
            responsive: [{
                breakpoint: 3000,
                options: {
                    maxParticles: 150,
                    color: '#ffffff',
                    connectParticles: true,
                    sizeVariations: 5,
                    speed: .5,
                    minDistance: 120,
                }
            },]
        });
    };   
}
if(sole.element("errorparticle")){
    window.onload = function() {
        Particles.init({
            selector: '.errorparticle',
            responsive: [{
                breakpoint: 3000,
                options: {
                    maxParticles: 150,
                    color: '#ffffff',
                    connectParticles: false,
                    sizeVariations: 5,
                    speed: .5,
                    minDistance: 120,
                }
            },]
        });
    };   
}