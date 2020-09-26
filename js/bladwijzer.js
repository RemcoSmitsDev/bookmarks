const tl = gsap.timeline({defaults: { ease: 'power1.out' }});
tl.fromTo('#item', { y: '-70%' }, { y: '0%', opacity: 100, duration: 1 });
$("#show-updates").click((e) => {
    $("#updates").toggleClass("opacity-0 pointer-events-none");
});