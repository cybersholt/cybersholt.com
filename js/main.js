var getQueryString = function (e, t) {
    var r = t ? t : window.location.href
        , n = new RegExp("[?&]" + e + "=([^&#]*)", "i")
        , i = n.exec(r);
    return i ? i[1] : null
};

!function (e) {
    console.log('e');

    1 != getQueryString("skipGL") && e.get("/frag.glsl", function (t) {

        function n() {
            var e = (Date.now() - f.timeLoad) / 1e3;
            o = 2 * a * Math.sin(.025 * e) - a,
                o += 1 / 3600,
                i += o,
                r += 5e-4,
                f.setUniform("time", i),
                f.setUniform("hue", r),
                requestAnimationFrame(n)
        }

        var i = 3e4 * Math.random()
            , o = 0
            , a = 1 / 180
            , r = 0
            , m = .8 * Math.random()
            , s = m + .1
            , d = 1.5 + .5 * Math.random();
        console.log([i, m, s, d]);
        var h = document.getElementById("generative-container")
            , c = document.createElement("canvas");
        c.id = "generative-canvas",
            c.width = .5 * window.screen.width,
            c.height = .5 * window.screen.height,
            h.appendChild(c);
        var f = new GlslCanvas(c);
        //console.log(f.load());
        f.load(t),
            f.setUniform("time", i),
            f.setUniform("hue", 0),
            f.setUniform("timeModZ", s),
            f.setUniform("timeModY", m),
            f.setUniform("complexity", d),
            f.setUniform("rez", 1 * c.width, 1 * c.height);
        var l = !0;
        f.on("render", function () {
            l && (e(c).css({
                opacity: 1
            }),
                l = !0)
        }),
            n()
    })
}(jQuery);