/*!
 * Splide.js
 * Version  : 2.4.20
 * License  : MIT
 * Copyright: 2020 Naotoshi Fujita
 */ !(function () {
    "use strict";
    var t = {
            d: function (n, e) {
                for (var i in e)
                    t.o(e, i) &&
                        !t.o(n, i) &&
                        Object.defineProperty(n, i, {
                            enumerable: !0,
                            get: e[i],
                        });
            },
            o: function (t, n) {
                return Object.prototype.hasOwnProperty.call(t, n);
            },
            r: function (t) {
                "undefined" != typeof Symbol &&
                    Symbol.toStringTag &&
                    Object.defineProperty(t, Symbol.toStringTag, {
                        value: "Module",
                    }),
                    Object.defineProperty(t, "__esModule", { value: !0 });
            },
        },
        n = {};
    t.r(n),
        t.d(n, {
            CREATED: function () {
                return R;
            },
            DESTROYED: function () {
                return X;
            },
            IDLE: function () {
                return F;
            },
            MOUNTED: function () {
                return B;
            },
            MOVING: function () {
                return G;
            },
        });
    function e() {
        return (e =
            Object.assign ||
            function (t) {
                for (var n = 1; n < arguments.length; n++) {
                    var e = arguments[n];
                    for (var i in e)
                        Object.prototype.hasOwnProperty.call(e, i) &&
                            (t[i] = e[i]);
                }
                return t;
            }).apply(this, arguments);
    }
    var i = Object.keys;
    function o(t, n) {
        i(t).some(function (e, i) {
            return n(t[e], e, i);
        });
    }
    function r(t) {
        return i(t).map(function (n) {
            return t[n];
        });
    }
    function s(t) {
        return "object" == typeof t;
    }
    function a(t, n) {
        var i = e({}, t);
        return (
            o(n, function (t, n) {
                s(t)
                    ? (s(i[n]) || (i[n] = {}), (i[n] = a(i[n], t)))
                    : (i[n] = t);
            }),
            i
        );
    }
    function u(t) {
        return Array.isArray(t) ? t : [t];
    }
    function c(t, n, e) {
        return Math.min(Math.max(t, n > e ? e : n), n > e ? n : e);
    }
    function d(t, n) {
        var e = 0;
        return t.replace(/%s/g, function () {
            return u(n)[e++];
        });
    }
    function f(t) {
        var n = typeof t;
        return "number" === n && t > 0
            ? parseFloat(t) + "px"
            : "string" === n
            ? t
            : "";
    }
    function l(t) {
        return t < 10 ? "0" + t : t;
    }
    function h(t, n) {
        if ("string" == typeof n) {
            var e = m("div", {});
            E(e, { position: "absolute", width: n }),
                w(t, e),
                (n = e.clientWidth),
                b(e);
        }
        return +n || 0;
    }
    function p(t, n) {
        return t ? t.querySelector(n.split(" ")[0]) : null;
    }
    function g(t, n) {
        return v(t, n)[0];
    }
    function v(t, n) {
        return t
            ? r(t.children).filter(function (t) {
                  return P(t, n.split(" ")[0]) || t.tagName === n;
              })
            : [];
    }
    function m(t, n) {
        var e = document.createElement(t);
        return (
            o(n, function (t, n) {
                return C(e, n, t);
            }),
            e
        );
    }
    function y(t) {
        var n = m("div", {});
        return (n.innerHTML = t), n.firstChild;
    }
    function b(t) {
        u(t).forEach(function (t) {
            if (t) {
                var n = t.parentElement;
                n && n.removeChild(t);
            }
        });
    }
    function w(t, n) {
        t && t.appendChild(n);
    }
    function x(t, n) {
        if (t && n) {
            var e = n.parentElement;
            e && e.insertBefore(t, n);
        }
    }
    function E(t, n) {
        t &&
            o(n, function (n, e) {
                null !== n && (t.style[e] = n);
            });
    }
    function _(t, n, e) {
        t &&
            u(n).forEach(function (n) {
                n && t.classList[e ? "remove" : "add"](n);
            });
    }
    function k(t, n) {
        _(t, n, !1);
    }
    function S(t, n) {
        _(t, n, !0);
    }
    function P(t, n) {
        return !!t && t.classList.contains(n);
    }
    function C(t, n, e) {
        t && t.setAttribute(n, e);
    }
    function z(t, n) {
        return t ? t.getAttribute(n) : "";
    }
    function I(t, n) {
        u(n).forEach(function (n) {
            u(t).forEach(function (t) {
                return t && t.removeAttribute(n);
            });
        });
    }
    function M(t) {
        return t.getBoundingClientRect();
    }
    var T = "slide",
        A = "loop",
        O = "fade",
        L = function (t, n) {
            var e, i;
            return {
                mount: function () {
                    (e = n.Elements.list),
                        t.on(
                            "transitionend",
                            function (t) {
                                t.target === e && i && i();
                            },
                            e
                        );
                },
                start: function (o, r, s, a, u) {
                    var c = t.options,
                        d = n.Controller.edgeIndex,
                        f = c.speed;
                    (i = u),
                        t.is(T) &&
                            ((0 === s && r >= d) || (s >= d && 0 === r)) &&
                            (f = c.rewindSpeed || f),
                        E(e, {
                            transition: "transform " + f + "ms " + c.easing,
                            transform: "translate(" + a.x + "px," + a.y + "px)",
                        });
                },
            };
        },
        W = function (t, n) {
            function e(e) {
                var i = t.options;
                E(n.Elements.slides[e], {
                    transition: "opacity " + i.speed + "ms " + i.easing,
                });
            }
            return {
                mount: function () {
                    e(t.index);
                },
                start: function (t, i, o, r, s) {
                    var a = n.Elements.track;
                    E(a, { height: f(a.clientHeight) }),
                        e(i),
                        setTimeout(function () {
                            s(), E(a, { height: "" });
                        });
                },
            };
        };
    function H(t) {
        console.error("[SPLIDE] " + t);
    }
    function j(t, n) {
        if (!t) throw new Error(n);
    }
    var q = "splide",
        D = {
            active: "is-active",
            visible: "is-visible",
            loading: "is-loading",
        },
        N = {
            type: "slide",
            rewind: !1,
            speed: 400,
            rewindSpeed: 0,
            waitForTransition: !0,
            width: 0,
            height: 0,
            fixedWidth: 0,
            fixedHeight: 0,
            heightRatio: 0,
            autoWidth: !1,
            autoHeight: !1,
            perPage: 1,
            perMove: 0,
            clones: 0,
            start: 0,
            focus: !1,
            gap: 0,
            padding: 0,
            arrows: !0,
            arrowPath: "",
            pagination: !0,
            autoplay: !1,
            interval: 5e3,
            pauseOnHover: !0,
            pauseOnFocus: !0,
            resetProgress: !0,
            lazyLoad: !1,
            preloadPages: 1,
            easing: "cubic-bezier(.42,.65,.27,.99)",
            keyboard: "global",
            drag: !0,
            dragAngleThreshold: 30,
            swipeDistanceThreshold: 150,
            flickVelocityThreshold: 0.6,
            flickPower: 600,
            flickMaxPages: 1,
            direction: "ltr",
            cover: !1,
            accessibility: !0,
            slideFocus: !0,
            isNavigation: !1,
            trimSpace: !0,
            updateOnMove: !1,
            throttle: 100,
            destroy: !1,
            breakpoints: !1,
            classes: {
                root: q,
                slider: q + "__slider",
                track: q + "__track",
                list: q + "__list",
                slide: q + "__slide",
                container: q + "__slide__container",
                arrows: q + "__arrows",
                arrow: q + "__arrow",
                prev: q + "__arrow--prev",
                next: q + "__arrow--next",
                pagination: q + "__pagination",
                page: q + "__pagination__page",
                clone: q + "__slide--clone",
                progress: q + "__progress",
                bar: q + "__progress__bar",
                autoplay: q + "__autoplay",
                play: q + "__play",
                pause: q + "__pause",
                spinner: q + "__spinner",
                sr: q + "__sr",
            },
            i18n: {
                prev: "Previous slide",
                next: "Next slide",
                first: "Go to first slide",
                last: "Go to last slide",
                slideX: "Go to slide %s",
                pageX: "Go to page %s",
                play: "Start autoplay",
                pause: "Pause autoplay",
            },
        },
        R = 1,
        B = 2,
        F = 3,
        G = 4,
        X = 5;
    function V(t, n) {
        for (var e = 0; e < n.length; e++) {
            var i = n[e];
            (i.enumerable = i.enumerable || !1),
                (i.configurable = !0),
                "value" in i && (i.writable = !0),
                Object.defineProperty(t, i.key, i);
        }
    }
    var U = (function () {
            function t(t, e, i) {
                var o;
                void 0 === e && (e = {}),
                    void 0 === i && (i = {}),
                    (this.root =
                        t instanceof Element ? t : document.querySelector(t)),
                    j(this.root, "An invalid element/selector was given."),
                    (this.Components = null),
                    (this.Event = (function () {
                        var t = [];
                        function n(t) {
                            t.elm &&
                                t.elm.removeEventListener(
                                    t.event,
                                    t.handler,
                                    t.options
                                );
                        }
                        return {
                            on: function (n, e, i, o) {
                                void 0 === i && (i = null),
                                    void 0 === o && (o = {}),
                                    n.split(" ").forEach(function (n) {
                                        i && i.addEventListener(n, e, o),
                                            t.push({
                                                event: n,
                                                handler: e,
                                                elm: i,
                                                options: o,
                                            });
                                    });
                            },
                            off: function (e, i) {
                                void 0 === i && (i = null),
                                    e.split(" ").forEach(function (e) {
                                        t = t.filter(function (t) {
                                            return (
                                                !t ||
                                                t.event !== e ||
                                                t.elm !== i ||
                                                (n(t), !1)
                                            );
                                        });
                                    });
                            },
                            emit: function (n) {
                                for (
                                    var e = arguments.length,
                                        i = new Array(e > 1 ? e - 1 : 0),
                                        o = 1;
                                    o < e;
                                    o++
                                )
                                    i[o - 1] = arguments[o];
                                t.forEach(function (t) {
                                    t.elm ||
                                        t.event.split(".")[0] !== n ||
                                        t.handler.apply(t, i);
                                });
                            },
                            destroy: function () {
                                t.forEach(n), (t = []);
                            },
                        };
                    })()),
                    (this.State =
                        ((o = R),
                        {
                            set: function (t) {
                                o = t;
                            },
                            is: function (t) {
                                return t === o;
                            },
                        })),
                    (this.STATES = n),
                    (this._o = a(N, e)),
                    (this._i = 0),
                    (this._c = i),
                    (this._e = {}),
                    (this._t = null);
            }
            var e,
                i,
                s,
                u = t.prototype;
            return (
                (u.mount = function (t, n) {
                    var e = this;
                    void 0 === t && (t = this._e),
                        void 0 === n && (n = this._t),
                        this.State.set(R),
                        (this._e = t),
                        (this._t = n),
                        (this.Components = (function (t, n, e) {
                            var i = {};
                            return (
                                o(n, function (n, e) {
                                    i[e] = n(t, i, e.toLowerCase());
                                }),
                                e || (e = t.is(O) ? W : L),
                                (i.Transition = e(t, i)),
                                i
                            );
                        })(this, a(this._c, t), n));
                    try {
                        o(this.Components, function (t, n) {
                            var i = t.required;
                            void 0 === i || i
                                ? t.mount && t.mount()
                                : delete e.Components[n];
                        });
                    } catch (t) {
                        return void H(t.message);
                    }
                    var i = this.State;
                    return (
                        i.set(B),
                        o(this.Components, function (t) {
                            t.mounted && t.mounted();
                        }),
                        this.emit("mounted"),
                        i.set(F),
                        this.emit("ready"),
                        E(this.root, { visibility: "visible" }),
                        this.on("move drag", function () {
                            return i.set(G);
                        }).on("moved dragged", function () {
                            return i.set(F);
                        }),
                        this
                    );
                }),
                (u.sync = function (t) {
                    return (this.sibling = t), this;
                }),
                (u.on = function (t, n, e, i) {
                    return (
                        void 0 === e && (e = null),
                        void 0 === i && (i = {}),
                        this.Event.on(t, n, e, i),
                        this
                    );
                }),
                (u.off = function (t, n) {
                    return (
                        void 0 === n && (n = null), this.Event.off(t, n), this
                    );
                }),
                (u.emit = function (t) {
                    for (
                        var n,
                            e = arguments.length,
                            i = new Array(e > 1 ? e - 1 : 0),
                            o = 1;
                        o < e;
                        o++
                    )
                        i[o - 1] = arguments[o];
                    return (n = this.Event).emit.apply(n, [t].concat(i)), this;
                }),
                (u.go = function (t, n) {
                    return (
                        void 0 === n && (n = this.options.waitForTransition),
                        (this.State.is(F) || (this.State.is(G) && !n)) &&
                            this.Components.Controller.go(t, !1),
                        this
                    );
                }),
                (u.is = function (t) {
                    return t === this._o.type;
                }),
                (u.add = function (t, n) {
                    return (
                        void 0 === n && (n = -1),
                        this.Components.Elements.add(
                            t,
                            n,
                            this.refresh.bind(this)
                        ),
                        this
                    );
                }),
                (u.remove = function (t) {
                    return (
                        this.Components.Elements.remove(t), this.refresh(), this
                    );
                }),
                (u.refresh = function () {
                    return (
                        this.emit("refresh:before")
                            .emit("refresh")
                            .emit("resize"),
                        this
                    );
                }),
                (u.destroy = function (t) {
                    var n = this;
                    if ((void 0 === t && (t = !0), !this.State.is(R)))
                        return (
                            r(this.Components)
                                .reverse()
                                .forEach(function (n) {
                                    n.destroy && n.destroy(t);
                                }),
                            this.emit("destroy", t),
                            this.Event.destroy(),
                            this.State.set(X),
                            this
                        );
                    this.on("ready", function () {
                        return n.destroy(t);
                    });
                }),
                (e = t),
                (i = [
                    {
                        key: "index",
                        get: function () {
                            return this._i;
                        },
                        set: function (t) {
                            this._i = parseInt(t);
                        },
                    },
                    {
                        key: "length",
                        get: function () {
                            return this.Components.Elements.length;
                        },
                    },
                    {
                        key: "options",
                        get: function () {
                            return this._o;
                        },
                        set: function (t) {
                            var n = this.State.is(R);
                            n || this.emit("update"),
                                (this._o = a(this._o, t)),
                                n || this.emit("updated", this._o);
                        },
                    },
                    {
                        key: "classes",
                        get: function () {
                            return this._o.classes;
                        },
                    },
                    {
                        key: "i18n",
                        get: function () {
                            return this._o.i18n;
                        },
                    },
                ]) && V(e.prototype, i),
                s && V(e, s),
                t
            );
        })(),
        Y = function (t) {
            var n = z(t.root, "data-splide");
            if (n)
                try {
                    t.options = JSON.parse(n);
                } catch (t) {
                    H(t.message);
                }
            return {
                mount: function () {
                    t.State.is(R) && (t.index = t.options.start);
                },
            };
        },
        J = "rtl",
        K = "ttb",
        Q = "update.slide",
        Z = function (t, n) {
            var e = t.root,
                i = t.classes,
                s = [];
            if (!e.id) {
                window.splide = window.splide || {};
                var a = window.splide.uid || 0;
                (window.splide.uid = ++a), (e.id = "splide" + l(a));
            }
            var u = {
                mount: function () {
                    var n = this;
                    this.init(),
                        t
                            .on("refresh", function () {
                                n.destroy(), n.init();
                            })
                            .on("updated", function () {
                                S(e, c()), k(e, c());
                            });
                },
                destroy: function () {
                    s.forEach(function (t) {
                        t.destroy();
                    }),
                        (s = []),
                        S(e, c());
                },
                init: function () {
                    var t = this;
                    !(function () {
                        (u.slider = g(e, i.slider)),
                            (u.track = p(e, "." + i.track)),
                            (u.list = g(u.track, i.list)),
                            j(
                                u.track && u.list,
                                "Track or list was not found."
                            ),
                            (u.slides = v(u.list, i.slide));
                        var t = d(i.arrows);
                        u.arrows = {
                            prev: p(t, "." + i.prev),
                            next: p(t, "." + i.next),
                        };
                        var n = d(i.autoplay);
                        (u.bar = p(d(i.progress), "." + i.bar)),
                            (u.play = p(n, "." + i.play)),
                            (u.pause = p(n, "." + i.pause)),
                            (u.track.id = u.track.id || e.id + "-track"),
                            (u.list.id = u.list.id || e.id + "-list");
                    })(),
                        k(e, c()),
                        this.slides.forEach(function (n, e) {
                            t.register(n, e, -1);
                        });
                },
                register: function (n, e, i) {
                    var o = (function (t, n, e, i) {
                        var o = t.options.updateOnMove,
                            s =
                                "ready.slide updated.slide resized.slide moved.slide" +
                                (o ? " move.slide" : ""),
                            a = {
                                slide: i,
                                index: n,
                                realIndex: e,
                                container: g(i, t.classes.container),
                                isClone: e > -1,
                                mount: function () {
                                    var r = this;
                                    this.isClone ||
                                        (i.id =
                                            t.root.id + "-slide" + l(n + 1)),
                                        t
                                            .on(s, function () {
                                                return r.update();
                                            })
                                            .on(Q, c)
                                            .on(
                                                "click",
                                                function () {
                                                    return t.emit("click", r);
                                                },
                                                i
                                            ),
                                        o &&
                                            t.on("move.slide", function (t) {
                                                t === e && u(!0, !1);
                                            }),
                                        E(i, { display: "" }),
                                        (this.styles = z(i, "style") || "");
                                },
                                destroy: function () {
                                    t.off(s).off(Q).off("click", i),
                                        S(i, r(D)),
                                        c(),
                                        I(this.container, "style");
                                },
                                update: function () {
                                    u(this.isActive(), !1),
                                        u(this.isVisible(), !0);
                                },
                                isActive: function () {
                                    return t.index === n;
                                },
                                isVisible: function () {
                                    var n = this.isActive();
                                    if (t.is(O) || n) return n;
                                    var e = Math.ceil,
                                        o = M(t.Components.Elements.track),
                                        r = M(i);
                                    return t.options.direction === K
                                        ? o.top <= r.top &&
                                              r.bottom <= e(o.bottom)
                                        : o.left <= r.left &&
                                              r.right <= e(o.right);
                                },
                                isWithin: function (e, i) {
                                    var o = Math.abs(e - n);
                                    return (
                                        t.is(T) ||
                                            this.isClone ||
                                            (o = Math.min(o, t.length - o)),
                                        o < i
                                    );
                                },
                            };
                        function u(n, e) {
                            var o = e ? "visible" : "active",
                                r = D[o];
                            n
                                ? (k(i, r), t.emit("" + o, a))
                                : P(i, r) &&
                                  (S(i, r),
                                  t.emit(e ? "hidden" : "inactive", a));
                        }
                        function c() {
                            C(i, "style", a.styles);
                        }
                        return a;
                    })(t, e, i, n);
                    o.mount(), s.push(o);
                },
                getSlide: function (t) {
                    return s.filter(function (n) {
                        return n.index === t;
                    })[0];
                },
                getSlides: function (t) {
                    return t
                        ? s
                        : s.filter(function (t) {
                              return !t.isClone;
                          });
                },
                getSlidesByPage: function (e) {
                    var i = n.Controller.toIndex(e),
                        o = t.options,
                        r = !1 !== o.focus ? 1 : o.perPage;
                    return s.filter(function (t) {
                        var n = t.index;
                        return i <= n && n < i + r;
                    });
                },
                add: function (t, n, e) {
                    if (
                        ("string" == typeof t && (t = y(t)),
                        t instanceof Element)
                    ) {
                        var i = this.slides[n];
                        E(t, { display: "none" }),
                            i
                                ? (x(t, i), this.slides.splice(n, 0, t))
                                : (w(this.list, t), this.slides.push(t)),
                            (function (t, n) {
                                var e = t.querySelectorAll("img"),
                                    i = e.length;
                                if (i) {
                                    var r = 0;
                                    o(e, function (t) {
                                        t.onload = t.onerror = function () {
                                            ++r === i && n();
                                        };
                                    });
                                } else n();
                            })(t, function () {
                                e && e(t);
                            });
                    }
                },
                remove: function (t) {
                    b(this.slides.splice(t, 1)[0]);
                },
                each: function (t) {
                    s.forEach(t);
                },
                get length() {
                    return this.slides.length;
                },
                get total() {
                    return s.length;
                },
            };
            function c() {
                var n = i.root,
                    e = t.options;
                return [
                    n + "--" + e.type,
                    n + "--" + e.direction,
                    e.drag ? n + "--draggable" : "",
                    e.isNavigation ? n + "--nav" : "",
                    D.active,
                ];
            }
            function d(t) {
                return g(e, t) || g(u.slider, t);
            }
            return u;
        },
        $ = Math.floor,
        tt = function (t, n) {
            var e,
                i,
                o = {
                    mount: function () {
                        (e = t.options),
                            (i = t.is(A)),
                            t
                                .on("move", function (n) {
                                    t.index = n;
                                })
                                .on("updated refresh", function (n) {
                                    (e = n || e),
                                        (t.index = c(t.index, 0, o.edgeIndex));
                                });
                    },
                    go: function (t, e) {
                        var i = this.trim(this.parse(t));
                        n.Track.go(i, this.rewind(i), e);
                    },
                    parse: function (n) {
                        var i = t.index,
                            r = String(n).match(/([+\-<>]+)(\d+)?/),
                            s = r ? r[1] : "",
                            a = r ? parseInt(r[2]) : 0;
                        switch (s) {
                            case "+":
                                i += a || 1;
                                break;
                            case "-":
                                i -= a || 1;
                                break;
                            case ">":
                            case "<":
                                i = (function (t, n, i) {
                                    if (t > -1) return o.toIndex(t);
                                    var r = e.perMove,
                                        s = i ? -1 : 1;
                                    if (r) return n + r * s;
                                    return o.toIndex(o.toPage(n) + s);
                                })(a, i, "<" === s);
                                break;
                            default:
                                i = parseInt(n);
                        }
                        return i;
                    },
                    toIndex: function (n) {
                        if (r()) return n;
                        var i = t.length,
                            o = e.perPage,
                            s = n * o;
                        return (
                            i - o <=
                                (s -= (this.pageLength * o - i) * $(s / i)) &&
                                s < i &&
                                (s = i - o),
                            s
                        );
                    },
                    toPage: function (n) {
                        if (r()) return n;
                        var i = t.length,
                            o = e.perPage;
                        return $(i - o <= n && n < i ? (i - 1) / o : n / o);
                    },
                    trim: function (t) {
                        return (
                            i ||
                                (t = e.rewind
                                    ? this.rewind(t)
                                    : c(t, 0, this.edgeIndex)),
                            t
                        );
                    },
                    rewind: function (t) {
                        var n = this.edgeIndex;
                        if (i) {
                            for (; t > n; ) t -= n + 1;
                            for (; t < 0; ) t += n + 1;
                        } else t > n ? (t = 0) : t < 0 && (t = n);
                        return t;
                    },
                    isRtl: function () {
                        return e.direction === J;
                    },
                    get pageLength() {
                        var n = t.length;
                        return r() ? n : Math.ceil(n / e.perPage);
                    },
                    get edgeIndex() {
                        var n = t.length;
                        return n
                            ? r() || e.isNavigation || i
                                ? n - 1
                                : n - e.perPage
                            : 0;
                    },
                    get prevIndex() {
                        var n = t.index - 1;
                        return (
                            (i || e.rewind) && (n = this.rewind(n)),
                            n > -1 ? n : -1
                        );
                    },
                    get nextIndex() {
                        var n = t.index + 1;
                        return (
                            (i || e.rewind) && (n = this.rewind(n)),
                            (t.index < n && n <= this.edgeIndex) || 0 === n
                                ? n
                                : -1
                        );
                    },
                };
            function r() {
                return !1 !== e.focus;
            }
            return o;
        },
        nt = Math.abs,
        et = function (t, n) {
            var e,
                i,
                o,
                r = t.options.direction === K,
                s = t.is(O),
                a = t.options.direction === J,
                u = !1,
                d = a ? 1 : -1,
                f = {
                    sign: d,
                    mount: function () {
                        (i = n.Elements), (e = n.Layout), (o = i.list);
                    },
                    mounted: function () {
                        var n = this;
                        s ||
                            (this.jump(0),
                            t.on("mounted resize updated", function () {
                                n.jump(t.index);
                            }));
                    },
                    go: function (e, i, o) {
                        var r = h(e),
                            a = t.index;
                        (t.State.is(G) && u) ||
                            ((u = e !== i),
                            o || t.emit("move", i, a, e),
                            Math.abs(r - this.position) >= 1 || s
                                ? n.Transition.start(
                                      e,
                                      i,
                                      a,
                                      this.toCoord(r),
                                      function () {
                                          l(e, i, a, o);
                                      }
                                  )
                                : e !== a && "move" === t.options.trimSpace
                                ? n.Controller.go(e + e - a, o)
                                : l(e, i, a, o));
                    },
                    jump: function (t) {
                        this.translate(h(t));
                    },
                    translate: function (t) {
                        E(o, {
                            transform:
                                "translate" + (r ? "Y" : "X") + "(" + t + "px)",
                        });
                    },
                    cancel: function () {
                        t.is(A) ? this.shift() : this.translate(this.position),
                            E(o, { transition: "" });
                    },
                    shift: function () {
                        var n = nt(this.position),
                            e = nt(this.toPosition(0)),
                            i = nt(this.toPosition(t.length)),
                            o = i - e;
                        n < e ? (n += o) : n > i && (n -= o),
                            this.translate(d * n);
                    },
                    trim: function (n) {
                        return !t.options.trimSpace || t.is(A)
                            ? n
                            : c(n, d * (e.totalSize() - e.size - e.gap), 0);
                    },
                    toIndex: function (t) {
                        var n = this,
                            e = 0,
                            o = 1 / 0;
                        return (
                            i.getSlides(!0).forEach(function (i) {
                                var r = i.index,
                                    s = nt(n.toPosition(r) - t);
                                s < o && ((o = s), (e = r));
                            }),
                            e
                        );
                    },
                    toCoord: function (t) {
                        return { x: r ? 0 : t, y: r ? t : 0 };
                    },
                    toPosition: function (t) {
                        var n = e.totalSize(t) - e.slideSize(t) - e.gap;
                        return d * (n + this.offset(t));
                    },
                    offset: function (n) {
                        var i = t.options.focus,
                            o = e.slideSize(n);
                        return "center" === i
                            ? -(e.size - o) / 2
                            : -(parseInt(i) || 0) * (o + e.gap);
                    },
                    get position() {
                        var t = r ? "top" : a ? "right" : "left";
                        return M(o)[t] - (M(i.track)[t] - e.padding[t] * d);
                    },
                };
            function l(n, e, i, r) {
                E(o, { transition: "" }),
                    (u = !1),
                    s || f.jump(e),
                    r || t.emit("moved", e, i, n);
            }
            function h(t) {
                return f.trim(f.toPosition(t));
            }
            return f;
        },
        it = function (t, n) {
            var e = [],
                i = 0,
                o = n.Elements,
                r = {
                    mount: function () {
                        var n = this;
                        t.is(A) &&
                            (s(),
                            t
                                .on("refresh:before", function () {
                                    n.destroy();
                                })
                                .on("refresh", s)
                                .on("resize", function () {
                                    i !== a() && (n.destroy(), t.refresh());
                                }));
                    },
                    destroy: function () {
                        b(e), (e = []);
                    },
                    get clones() {
                        return e;
                    },
                    get length() {
                        return e.length;
                    },
                };
            function s() {
                r.destroy(),
                    (function (t) {
                        var n = o.length,
                            i = o.register;
                        if (n) {
                            for (var r = o.slides; r.length < t; )
                                r = r.concat(r);
                            r.slice(0, t).forEach(function (t, r) {
                                var s = u(t);
                                w(o.list, s), e.push(s), i(s, r + n, r % n);
                            }),
                                r.slice(-t).forEach(function (o, s) {
                                    var a = u(o);
                                    x(a, r[0]),
                                        e.push(a),
                                        i(a, s - t, (n + s - (t % n)) % n);
                                });
                        }
                    })((i = a()));
            }
            function a() {
                var n = t.options;
                if (n.clones) return n.clones;
                var e = n.autoWidth || n.autoHeight ? o.length : n.perPage,
                    i = n.direction === K ? "Height" : "Width",
                    r = h(t.root, n["fixed" + i]);
                return (
                    r && (e = Math.ceil(o.track["client" + i] / r)),
                    e * (n.drag ? n.flickMaxPages + 1 : 1)
                );
            }
            function u(n) {
                var e = n.cloneNode(!0);
                return k(e, t.classes.clone), I(e, "id"), e;
            }
            return r;
        };
    function ot(t, n) {
        var e;
        return function () {
            e ||
                (e = setTimeout(function () {
                    t(), (e = null);
                }, n));
        };
    }
    var rt = function (t, n) {
            var e,
                o,
                r = n.Elements,
                s = t.options.direction === K,
                a =
                    ((e = {
                        mount: function () {
                            t
                                .on(
                                    "resize load",
                                    ot(function () {
                                        t.emit("resize");
                                    }, t.options.throttle),
                                    window
                                )
                                .on("resize", c)
                                .on("updated refresh", u),
                                u(),
                                (this.totalSize = s
                                    ? this.totalHeight
                                    : this.totalWidth),
                                (this.slideSize = s
                                    ? this.slideHeight
                                    : this.slideWidth);
                        },
                        destroy: function () {
                            I([r.list, r.track], "style");
                        },
                        get size() {
                            return s ? this.height : this.width;
                        },
                    }),
                    (o = s
                        ? (function (t, n) {
                              var e,
                                  i,
                                  o = n.Elements,
                                  r = t.root;
                              return {
                                  margin: "marginBottom",
                                  init: function () {
                                      this.resize();
                                  },
                                  resize: function () {
                                      (i = t.options),
                                          (e = o.track),
                                          (this.gap = h(r, i.gap));
                                      var n = i.padding,
                                          s = h(r, n.top || n),
                                          a = h(r, n.bottom || n);
                                      (this.padding = { top: s, bottom: a }),
                                          E(e, {
                                              paddingTop: f(s),
                                              paddingBottom: f(a),
                                          });
                                  },
                                  totalHeight: function (n) {
                                      void 0 === n && (n = t.length - 1);
                                      var e = o.getSlide(n);
                                      return e
                                          ? M(e.slide).bottom -
                                                M(o.list).top +
                                                this.gap
                                          : 0;
                                  },
                                  slideWidth: function () {
                                      return h(r, i.fixedWidth || this.width);
                                  },
                                  slideHeight: function (t) {
                                      if (i.autoHeight) {
                                          var n = o.getSlide(t);
                                          return n ? n.slide.offsetHeight : 0;
                                      }
                                      var e =
                                          i.fixedHeight ||
                                          (this.height + this.gap) / i.perPage -
                                              this.gap;
                                      return h(r, e);
                                  },
                                  get width() {
                                      return e.clientWidth;
                                  },
                                  get height() {
                                      var t =
                                          i.height ||
                                          this.width * i.heightRatio;
                                      return (
                                          j(
                                              t,
                                              '"height" or "heightRatio" is missing.'
                                          ),
                                          h(r, t) -
                                              this.padding.top -
                                              this.padding.bottom
                                      );
                                  },
                              };
                          })(t, n)
                        : (function (t, n) {
                              var e,
                                  i = n.Elements,
                                  o = t.root,
                                  r = t.options;
                              return {
                                  margin:
                                      "margin" +
                                      (r.direction === J ? "Left" : "Right"),
                                  height: 0,
                                  init: function () {
                                      this.resize();
                                  },
                                  resize: function () {
                                      (r = t.options),
                                          (e = i.track),
                                          (this.gap = h(o, r.gap));
                                      var n = r.padding,
                                          s = h(o, n.left || n),
                                          a = h(o, n.right || n);
                                      (this.padding = { left: s, right: a }),
                                          E(e, {
                                              paddingLeft: f(s),
                                              paddingRight: f(a),
                                          });
                                  },
                                  totalWidth: function (n) {
                                      void 0 === n && (n = t.length - 1);
                                      var e = i.getSlide(n),
                                          o = 0;
                                      if (e) {
                                          var s = M(e.slide),
                                              a = M(i.list);
                                          (o =
                                              r.direction === J
                                                  ? a.right - s.left
                                                  : s.right - a.left),
                                              (o += this.gap);
                                      }
                                      return o;
                                  },
                                  slideWidth: function (t) {
                                      if (r.autoWidth) {
                                          var n = i.getSlide(t);
                                          return n ? n.slide.offsetWidth : 0;
                                      }
                                      var e =
                                          r.fixedWidth ||
                                          (this.width + this.gap) / r.perPage -
                                              this.gap;
                                      return h(o, e);
                                  },
                                  slideHeight: function () {
                                      var t =
                                          r.height ||
                                          r.fixedHeight ||
                                          this.width * r.heightRatio;
                                      return h(o, t);
                                  },
                                  get width() {
                                      return (
                                          e.clientWidth -
                                          this.padding.left -
                                          this.padding.right
                                      );
                                  },
                              };
                          })(t, n)),
                    i(o).forEach(function (t) {
                        e[t] ||
                            Object.defineProperty(
                                e,
                                t,
                                Object.getOwnPropertyDescriptor(o, t)
                            );
                    }),
                    e);
            function u() {
                a.init(),
                    E(t.root, { maxWidth: f(t.options.width) }),
                    r.each(function (t) {
                        t.slide.style[a.margin] = f(a.gap);
                    }),
                    c();
            }
            function c() {
                var n = t.options;
                a.resize(), E(r.track, { height: f(a.height) });
                var e = n.autoHeight ? null : f(a.slideHeight());
                r.each(function (t) {
                    E(t.container, { height: e }),
                        E(t.slide, {
                            width: n.autoWidth
                                ? null
                                : f(a.slideWidth(t.index)),
                            height: t.container ? null : e,
                        });
                }),
                    t.emit("resized");
            }
            return a;
        },
        st = Math.abs,
        at = function (t, n) {
            var e,
                i,
                r,
                s,
                a = n.Track,
                u = n.Controller,
                d = t.options.direction === K,
                f = d ? "y" : "x",
                l = {
                    disabled: !1,
                    mount: function () {
                        var e = this,
                            i = n.Elements,
                            r = i.track;
                        t.on("touchstart mousedown", h, r)
                            .on("touchmove mousemove", g, r, { passive: !1 })
                            .on(
                                "touchend touchcancel mouseleave mouseup dragend",
                                v,
                                r
                            )
                            .on("mounted refresh", function () {
                                o(
                                    i.list.querySelectorAll("img, a"),
                                    function (n) {
                                        t.off("dragstart", n).on(
                                            "dragstart",
                                            function (t) {
                                                t.preventDefault();
                                            },
                                            n,
                                            { passive: !1 }
                                        );
                                    }
                                );
                            })
                            .on("mounted updated", function () {
                                e.disabled = !t.options.drag;
                            });
                    },
                };
            function h(t) {
                l.disabled || s || p(t);
            }
            function p(t) {
                (e = a.toCoord(a.position)), (i = m(t, {})), (r = i);
            }
            function g(n) {
                if (i)
                    if (((r = m(n, i)), s)) {
                        if ((n.cancelable && n.preventDefault(), !t.is(O))) {
                            var o = e[f] + r.offset[f];
                            a.translate(
                                (function (n) {
                                    if (t.is(T)) {
                                        var e = a.sign,
                                            i = e * a.trim(a.toPosition(0)),
                                            o =
                                                e *
                                                a.trim(
                                                    a.toPosition(u.edgeIndex)
                                                );
                                        (n *= e) < i
                                            ? (n = i - 7 * Math.log(i - n))
                                            : n > o &&
                                              (n = o + 7 * Math.log(n - o)),
                                            (n *= e);
                                    }
                                    return n;
                                })(o)
                            );
                        }
                    } else
                        (function (n) {
                            var e = n.offset;
                            if (t.State.is(G) && t.options.waitForTransition)
                                return !1;
                            var i =
                                (180 * Math.atan(st(e.y) / st(e.x))) / Math.PI;
                            d && (i = 90 - i);
                            return i < t.options.dragAngleThreshold;
                        })(r) &&
                            (t.emit("drag", i), (s = !0), a.cancel(), p(n));
            }
            function v() {
                (i = null),
                    s &&
                        (t.emit("dragged", r),
                        (function (e) {
                            var i = e.velocity[f],
                                o = st(i);
                            if (o > 0) {
                                var r = t.options,
                                    s = t.index,
                                    d = i < 0 ? -1 : 1,
                                    l = s;
                                if (!t.is(O)) {
                                    var h = a.position;
                                    o > r.flickVelocityThreshold &&
                                        st(e.offset[f]) <
                                            r.swipeDistanceThreshold &&
                                        (h +=
                                            d *
                                            Math.min(
                                                o * r.flickPower,
                                                n.Layout.size *
                                                    (r.flickMaxPages || 1)
                                            )),
                                        (l = a.toIndex(h));
                                }
                                l === s && o > 0.1 && (l = s + d * a.sign),
                                    t.is(T) && (l = c(l, 0, u.edgeIndex)),
                                    u.go(l, r.isNavigation);
                            }
                        })(r),
                        (s = !1));
            }
            function m(t, n) {
                var e = t.timeStamp,
                    i = t.touches,
                    o = i ? i[0] : t,
                    r = o.clientX,
                    s = o.clientY,
                    a = n.to || {},
                    u = a.x,
                    c = void 0 === u ? r : u,
                    d = a.y,
                    f = { x: r - c, y: s - (void 0 === d ? s : d) },
                    l = e - (n.time || 0);
                return {
                    to: { x: r, y: s },
                    offset: f,
                    time: e,
                    velocity: { x: f.x / l, y: f.y / l },
                };
            }
            return l;
        },
        ut = function (t, n) {
            var e = !1;
            function i(t) {
                e &&
                    (t.preventDefault(),
                    t.stopPropagation(),
                    t.stopImmediatePropagation());
            }
            return {
                required: t.options.drag,
                mount: function () {
                    t.on("click", i, n.Elements.track, { capture: !0 })
                        .on("drag", function () {
                            e = !0;
                        })
                        .on("dragged", function () {
                            setTimeout(function () {
                                e = !1;
                            });
                        });
                },
            };
        },
        ct = 1,
        dt = 2,
        ft = 3,
        lt = function (t, n, e) {
            var i,
                o,
                r,
                s = t.classes,
                a = t.root,
                u = n.Elements;
            function c() {
                var r = n.Controller,
                    s = r.prevIndex,
                    a = r.nextIndex,
                    u = t.length > t.options.perPage || t.is(A);
                (i.disabled = s < 0 || !u),
                    (o.disabled = a < 0 || !u),
                    t.emit(e + ":updated", i, o, s, a);
            }
            function d(n) {
                return y(
                    '<button class="' +
                        s.arrow +
                        " " +
                        (n ? s.prev : s.next) +
                        '" type="button"><svg xmlns="http://www.w3.org/2000/svg"\tviewBox="0 0 40 40"\twidth="40"\theight="40"><path d="' +
                        (t.options.arrowPath ||
                            "m15.5 0.932-4.3 4.38 14.5 14.6-14.5 14.5 4.3 4.4 14.6-14.6 4.4-4.3-4.4-4.4-14.6-14.6z") +
                        '" />'
                );
            }
            return {
                required: t.options.arrows,
                mount: function () {
                    (i = u.arrows.prev),
                        (o = u.arrows.next),
                        (i && o) ||
                            !t.options.arrows ||
                            ((i = d(!0)),
                            (o = d(!1)),
                            (r = !0),
                            (function () {
                                var n = m("div", { class: s.arrows });
                                w(n, i), w(n, o);
                                var e = u.slider,
                                    r =
                                        "slider" === t.options.arrows && e
                                            ? e
                                            : a;
                                x(n, r.firstElementChild);
                            })()),
                        i &&
                            o &&
                            t
                                .on(
                                    "click",
                                    function () {
                                        t.go("<");
                                    },
                                    i
                                )
                                .on(
                                    "click",
                                    function () {
                                        t.go(">");
                                    },
                                    o
                                )
                                .on("mounted move updated refresh", c),
                        (this.arrows = { prev: i, next: o });
                },
                mounted: function () {
                    t.emit(e + ":mounted", i, o);
                },
                destroy: function () {
                    I([i, o], "disabled"), r && b(i.parentElement);
                },
            };
        },
        ht = "move.page",
        pt = "updated.page refresh.page",
        gt = function (t, n, e) {
            var i = {},
                o = n.Elements,
                r = {
                    mount: function () {
                        var n = t.options.pagination;
                        if (n) {
                            i = (function () {
                                var n = t.options,
                                    e = t.classes,
                                    i = m("ul", { class: e.pagination }),
                                    r = o
                                        .getSlides(!1)
                                        .filter(function (t) {
                                            return (
                                                !1 !== n.focus ||
                                                t.index % n.perPage == 0
                                            );
                                        })
                                        .map(function (n, r) {
                                            var s = m("li", {}),
                                                a = m("button", {
                                                    class: e.page,
                                                    type: "button",
                                                });
                                            return (
                                                w(s, a),
                                                w(i, s),
                                                t.on(
                                                    "click",
                                                    function () {
                                                        t.go(">" + r);
                                                    },
                                                    a
                                                ),
                                                {
                                                    li: s,
                                                    button: a,
                                                    page: r,
                                                    Slides: o.getSlidesByPage(
                                                        r
                                                    ),
                                                }
                                            );
                                        });
                                return { list: i, items: r };
                            })();
                            var e = o.slider;
                            w("slider" === n && e ? e : t.root, i.list),
                                t.on(ht, s);
                        }
                        t.off(pt).on(pt, function () {
                            r.destroy(),
                                t.options.pagination &&
                                    (r.mount(), r.mounted());
                        });
                    },
                    mounted: function () {
                        if (t.options.pagination) {
                            var n = t.index;
                            t.emit(e + ":mounted", i, this.getItem(n)),
                                s(n, -1);
                        }
                    },
                    destroy: function () {
                        b(i.list),
                            i.items &&
                                i.items.forEach(function (n) {
                                    t.off("click", n.button);
                                }),
                            t.off(ht),
                            (i = {});
                    },
                    getItem: function (t) {
                        return i.items[n.Controller.toPage(t)];
                    },
                    get data() {
                        return i;
                    },
                };
            function s(n, o) {
                var s = r.getItem(o),
                    a = r.getItem(n),
                    u = D.active;
                s && S(s.button, u),
                    a && k(a.button, u),
                    t.emit(e + ":updated", i, s, a);
            }
            return r;
        },
        vt = "data-splide-lazy",
        mt = "data-splide-lazy-srcset",
        yt = "aria-current",
        bt = "aria-controls",
        wt = "aria-label",
        xt = "aria-hidden",
        Et = "tabindex",
        _t = {
            ltr: { ArrowLeft: "<", ArrowRight: ">", Left: "<", Right: ">" },
            rtl: { ArrowLeft: ">", ArrowRight: "<", Left: ">", Right: "<" },
            ttb: { ArrowUp: "<", ArrowDown: ">", Up: "<", Down: ">" },
        },
        kt = function (t, n) {
            var e = t.i18n,
                i = n.Elements,
                o = [xt, Et, bt, wt, yt, "role"];
            function r(n, e) {
                C(n, xt, !e), t.options.slideFocus && C(n, Et, e ? 0 : -1);
            }
            function s(t, n) {
                var e = i.track.id;
                C(t, bt, e), C(n, bt, e);
            }
            function a(n, i, o, r) {
                var s = t.index,
                    a = o > -1 && s < o ? e.last : e.prev,
                    u = r > -1 && s > r ? e.first : e.next;
                C(n, wt, a), C(i, wt, u);
            }
            function u(n, i) {
                i && C(i.button, yt, !0),
                    n.items.forEach(function (n) {
                        var i = t.options,
                            o = d(
                                !1 === i.focus && i.perPage > 1
                                    ? e.pageX
                                    : e.slideX,
                                n.page + 1
                            ),
                            r = n.button,
                            s = n.Slides.map(function (t) {
                                return t.slide.id;
                            });
                        C(r, bt, s.join(" ")), C(r, wt, o);
                    });
            }
            function c(t, n, e) {
                n && I(n.button, yt), e && C(e.button, yt, !0);
            }
            function f(t) {
                i.each(function (n) {
                    var i = n.slide,
                        o = n.realIndex;
                    h(i) || C(i, "role", "button");
                    var r = o > -1 ? o : n.index,
                        s = d(e.slideX, r + 1),
                        a = t.Components.Elements.getSlide(r);
                    C(i, wt, s), a && C(i, bt, a.slide.id);
                });
            }
            function l(t, n) {
                var e = t.slide;
                n ? C(e, yt, !0) : I(e, yt);
            }
            function h(t) {
                return "BUTTON" === t.tagName;
            }
            return {
                required: t.options.accessibility,
                mount: function () {
                    t
                        .on("visible", function (t) {
                            r(t.slide, !0);
                        })
                        .on("hidden", function (t) {
                            r(t.slide, !1);
                        })
                        .on("arrows:mounted", s)
                        .on("arrows:updated", a)
                        .on("pagination:mounted", u)
                        .on("pagination:updated", c)
                        .on("refresh", function () {
                            I(n.Clones.clones, o);
                        }),
                        t.options.isNavigation &&
                            t
                                .on("navigation:mounted navigation:updated", f)
                                .on("active", function (t) {
                                    l(t, !0);
                                })
                                .on("inactive", function (t) {
                                    l(t, !1);
                                }),
                        ["play", "pause"].forEach(function (t) {
                            var n = i[t];
                            n &&
                                (h(n) || C(n, "role", "button"),
                                C(n, bt, i.track.id),
                                C(n, wt, e[t]));
                        });
                },
                destroy: function () {
                    var t = n.Arrows,
                        e = t ? t.arrows : {};
                    I(i.slides.concat([e.prev, e.next, i.play, i.pause]), o);
                },
            };
        },
        St = "move.sync",
        Pt = "mouseup touchend",
        Ct = [" ", "Enter", "Spacebar"],
        zt = {
            Options: Y,
            Breakpoints: function (t) {
                var n,
                    e,
                    i = t.options.breakpoints,
                    o = ot(s, 50),
                    r = [];
                function s() {
                    var o,
                        s = (o = r.filter(function (t) {
                            return t.mql.matches;
                        })[0])
                            ? o.point
                            : -1;
                    if (s !== e) {
                        e = s;
                        var a = t.State,
                            u = i[s] || n,
                            c = u.destroy;
                        c
                            ? ((t.options = n), t.destroy("completely" === c))
                            : (a.is(X) && t.mount(), (t.options = u));
                    }
                }
                return {
                    required: i && matchMedia,
                    mount: function () {
                        (r = Object.keys(i)
                            .sort(function (t, n) {
                                return +t - +n;
                            })
                            .map(function (t) {
                                return {
                                    point: t,
                                    mql: matchMedia("(max-width:" + t + "px)"),
                                };
                            })),
                            this.destroy(!0),
                            addEventListener("resize", o),
                            (n = t.options),
                            s();
                    },
                    destroy: function (t) {
                        t && removeEventListener("resize", o);
                    },
                };
            },
            Controller: tt,
            Elements: Z,
            Track: et,
            Clones: it,
            Layout: rt,
            Drag: at,
            Click: ut,
            Autoplay: function (t, n, e) {
                var i,
                    o = [],
                    r = n.Elements,
                    s = {
                        required: t.options.autoplay,
                        mount: function () {
                            var n = t.options;
                            r.slides.length > n.perPage &&
                                ((i = (function (t, n, e) {
                                    var i,
                                        o,
                                        r,
                                        s = window.requestAnimationFrame,
                                        a = !0,
                                        u = function u(c) {
                                            a ||
                                                (i ||
                                                    ((i = c),
                                                    r && r < 1 && (i -= r * n)),
                                                (r = (o = c - i) / n),
                                                o >= n &&
                                                    ((i = 0), (r = 1), t()),
                                                e && e(r),
                                                s(u));
                                        };
                                    return {
                                        pause: function () {
                                            (a = !0), (i = 0);
                                        },
                                        play: function (t) {
                                            (i = 0),
                                                t && (r = 0),
                                                a && ((a = !1), s(u));
                                        },
                                    };
                                })(
                                    function () {
                                        t.go(">");
                                    },
                                    n.interval,
                                    function (n) {
                                        t.emit(e + ":playing", n),
                                            r.bar &&
                                                E(r.bar, {
                                                    width: 100 * n + "%",
                                                });
                                    }
                                )),
                                (function () {
                                    var n = t.options,
                                        e = t.sibling,
                                        i = [t.root, e ? e.root : null];
                                    n.pauseOnHover &&
                                        (a(i, "mouseleave", ct, !0),
                                        a(i, "mouseenter", ct, !1));
                                    n.pauseOnFocus &&
                                        (a(i, "focusout", dt, !0),
                                        a(i, "focusin", dt, !1));
                                    r.play &&
                                        t.on(
                                            "click",
                                            function () {
                                                s.play(dt), s.play(ft);
                                            },
                                            r.play
                                        );
                                    r.pause && a([r.pause], "click", ft, !1);
                                    t.on("move refresh", function () {
                                        s.play();
                                    }).on("destroy", function () {
                                        s.pause();
                                    });
                                })(),
                                this.play());
                        },
                        play: function (n) {
                            void 0 === n && (n = 0),
                                (o = o.filter(function (t) {
                                    return t !== n;
                                })).length ||
                                    (t.emit(e + ":play"),
                                    i.play(t.options.resetProgress));
                        },
                        pause: function (n) {
                            void 0 === n && (n = 0),
                                i.pause(),
                                -1 === o.indexOf(n) && o.push(n),
                                1 === o.length && t.emit(e + ":pause");
                        },
                    };
                function a(n, e, i, o) {
                    n.forEach(function (n) {
                        t.on(
                            e,
                            function () {
                                s[o ? "play" : "pause"](i);
                            },
                            n
                        );
                    });
                }
                return s;
            },
            Cover: function (t, n) {
                function e(t) {
                    n.Elements.each(function (n) {
                        var e = g(n.slide, "IMG") || g(n.container, "IMG");
                        e && e.src && i(e, t);
                    });
                }
                function i(t, n) {
                    E(t.parentElement, {
                        background: n
                            ? ""
                            : 'center/cover no-repeat url("' + t.src + '")',
                    }),
                        E(t, { display: n ? "" : "none" });
                }
                return {
                    required: t.options.cover,
                    mount: function () {
                        t.on("lazyload:loaded", function (t) {
                            i(t, !1);
                        }),
                            t.on("mounted updated refresh", function () {
                                return e(!1);
                            });
                    },
                    destroy: function () {
                        e(!0);
                    },
                };
            },
            Arrows: lt,
            Pagination: gt,
            LazyLoad: function (t, n, e) {
                var i,
                    r,
                    s = t.options,
                    a = "sequential" === s.lazyLoad;
                function u() {
                    (r = []), (i = 0);
                }
                function c(n) {
                    (n = isNaN(n) ? t.index : n),
                        (r = r.filter(function (t) {
                            return (
                                !t.Slide.isWithin(
                                    n,
                                    s.perPage * (s.preloadPages + 1)
                                ) || (d(t.img, t.Slide), !1)
                            );
                        }))[0] || t.off("moved." + e);
                }
                function d(n, e) {
                    k(e.slide, D.loading);
                    var i = m("span", { class: t.classes.spinner });
                    w(n.parentElement, i),
                        (n.onload = function () {
                            l(n, i, e, !1);
                        }),
                        (n.onerror = function () {
                            l(n, i, e, !0);
                        }),
                        C(n, "srcset", z(n, mt) || ""),
                        C(n, "src", z(n, vt) || "");
                }
                function f() {
                    if (i < r.length) {
                        var t = r[i];
                        d(t.img, t.Slide);
                    }
                    i++;
                }
                function l(n, i, o, r) {
                    S(o.slide, D.loading),
                        r ||
                            (b(i),
                            E(n, { display: "" }),
                            t.emit(e + ":loaded", n).emit("resize")),
                        a && f();
                }
                return {
                    required: s.lazyLoad,
                    mount: function () {
                        t.on("mounted refresh", function () {
                            u(),
                                n.Elements.each(function (t) {
                                    o(
                                        t.slide.querySelectorAll(
                                            "[data-splide-lazy], [" + mt + "]"
                                        ),
                                        function (n) {
                                            n.src ||
                                                n.srcset ||
                                                (r.push({ img: n, Slide: t }),
                                                E(n, { display: "none" }));
                                        }
                                    );
                                }),
                                a && f();
                        }),
                            a || t.on("mounted refresh moved." + e, c);
                    },
                    destroy: u,
                };
            },
            Keyboard: function (t) {
                var n;
                return {
                    mount: function () {
                        t.on("mounted updated", function () {
                            var e = t.options,
                                i = t.root,
                                o = _t[e.direction],
                                r = e.keyboard;
                            n && (t.off("keydown", n), I(i, Et)),
                                r &&
                                    ("focused" === r
                                        ? ((n = i), C(i, Et, 0))
                                        : (n = document),
                                    t.on(
                                        "keydown",
                                        function (n) {
                                            o[n.key] && t.go(o[n.key]);
                                        },
                                        n
                                    ));
                        });
                    },
                };
            },
            Sync: function (t) {
                var n = t.sibling,
                    e = n && n.options.isNavigation;
                function i() {
                    t.on(St, function (t, e, i) {
                        n.off(St).go(n.is(A) ? i : t, !1), o();
                    });
                }
                function o() {
                    n.on(St, function (n, e, o) {
                        t.off(St).go(t.is(A) ? o : n, !1), i();
                    });
                }
                function r() {
                    n.Components.Elements.each(function (n) {
                        var e = n.slide,
                            i = n.index;
                        t.off(Pt, e).on(
                            Pt,
                            function (t) {
                                (t.button && 0 !== t.button) || s(i);
                            },
                            e
                        ),
                            t.off("keyup", e).on(
                                "keyup",
                                function (t) {
                                    Ct.indexOf(t.key) > -1 &&
                                        (t.preventDefault(), s(i));
                                },
                                e,
                                { passive: !1 }
                            );
                    });
                }
                function s(e) {
                    t.State.is(F) && n.go(e);
                }
                return {
                    required: !!n,
                    mount: function () {
                        i(),
                            o(),
                            e &&
                                (r(),
                                t.on("refresh", function () {
                                    setTimeout(function () {
                                        r(), n.emit("navigation:updated", t);
                                    });
                                }));
                    },
                    mounted: function () {
                        e && n.emit("navigation:mounted", t);
                    },
                };
            },
            A11y: kt,
        };
    var It = (function (t) {
        var n, e;
        function i(n, e) {
            return t.call(this, n, e, zt) || this;
        }
        return (
            (e = t),
            ((n = i).prototype = Object.create(e.prototype)),
            (n.prototype.constructor = n),
            (n.__proto__ = e),
            i
        );
    })(U);
    window.Splide = It;
})();
