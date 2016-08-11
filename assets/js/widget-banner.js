/**
 * Jon Chambers
 * jchambers.dev@gmail.com
 *
 */

/**
 *
 */
var WidgetBanner = (function () {
    "use strict";
    /**
     *
     * @type {string}
     */
    var object_id = 'WidgetBanner';


    /**
     *
     * @constructor
     */
    function WidgetBanner() {
        this.container_id = '';
        this.container = '';
        this.items = [];
        this.timer = {duration: 0, i: -1, last: -1, trans: 'fade', easing: 'linear', pause: 0, timer_id: 0};
        this.timout_id = 0;
        this.pause = 0;

    }

    WidgetBanner.prototype = {

        /**
         *
         * @param container_id
         */
        set_container_id: function (container_id) {
            this.container_id = container_id;
        },

        /**
         *
         */
        setup: function () {
            var _this = this;
            _this.height = 0;

            _this.container = jQuery(this.container_id);

            _this.container.find('.arrow-left').click(function () {
                var _i = _this.container.find('.' + object_id + '-item[item_on=1]').attr('item_id') * 1.00;
                _i = _this.get_i(_i - 1.00);
                clearTimeout(_this.timer.timer_id);
                _this.next_i(_i);
                var _f = '_this.f_' + _this.timer.trans + '()';
                eval(_f);
            });
            _this.container.find('.arrow-right').click(function () {
                var _i = _this.container.find('.' + object_id + '-item[item_on=1]').attr('item_id') * 1.00;
                _i = _this.get_i(_i + 1.00);
                clearTimeout(_this.timer.timer_id);
                _this.next_i(_i);
                var _f = '_this.f_' + _this.timer.trans + '()';
                eval(_f);
            });

            _this.container.find('.icon-pause').click(function () {
                clearTimeout(_this.timer.timer_id);
                _this.pause = 1;
                _this.container.find('.icon-pause').hide();
                _this.container.find('.icon-play').show();
            });

            _this.container.find('.icon-play').click(function () {
                clearTimeout(_this.timer.timer_id);
                _this.pause = 0;
                _this.next_i(_this.get_i(_this.timer.i));
                _this.timer.pause = 100;
                _this.f_timer();
                _this.container.find('.icon-play').hide();
            });

            _this.timer = {
                duration: _this.container.attr('item_duration'),
                transition: _this.container.attr('item_transition'),
                easing: _this.container.attr('item_type'),
                pause: 0
            };

            _this.container
                .find('.' + object_id + '-item')
                .each(function () {
                    var $this = jQuery(this);
                    _this.items.push({
                        pause: $this.attr('item_pause'),
                        ratio: $this.attr('item_ratio'),
                        img: $this.find('img').attr('src')
                    });
                });

            var $banner = _this.container.find('.' + object_id + '-item[item_on=1]');
            $banner.appendTo(_this.container_id);

            switch (this.timer.transition) {
                case 'Fade':
                    _this.container.find('.' + object_id + '-item').addClass('absolute');
                    jQuery('.' + object_id + '-item[item_on=1]').removeClass('absolute');
                    _this.timer.trans = 'fade';
                    break;
                case 'Slide Left':
                    _this.container.find('.' + object_id + '-item').addClass('absolute').css({opacity: 1});
                    jQuery('.' + object_id + '-item[item_on=1]').removeClass('absolute');
                    _this.timer.trans = 'slide_left';
                    break;
                case 'Slide Right':
                    _this.container.find('.' + object_id + '-item').addClass('absolute').css({opacity: 1});
                    jQuery('.' + object_id + '-item[item_on=1]').removeClass('absolute');
                    _this.timer.trans = 'slide_right';
                    break;
            }
            _this.next_i(1);
            _this.f_timer();

            _this.on_resize();
        },


        f_timer: function () {
            var _this = this;
            if (_this.pause) {
                return;
            }
            _this.timer.timer_id = setTimeout(function () {
                var _f = '_this.f_' + _this.timer.trans + '()';
                eval(_f);
            }, _this.timer.pause);
        },

        /**
         *
         */
        f_fade: function () {
            var _this = this;
            var $banner = jQuery('.' + object_id + '-item[item_id=' + _this.timer.i + ']');
            $banner.appendTo(_this.container_id);
            setTimeout(function () {
                clearTimeout(_this.timer.timer_id);
                $banner.animate(
                    {opacity: 1},
                    _this.timer.duration * 1.00, "" + _this.timer.easing,
                    function () {
                        var $item = _this.container.find('.' + object_id + '-item[item_on=1]');
                        $item.css({opacity: 0}).attr('item_on', '0');
                        $banner.attr('item_on', '1');
                        _this.next_i(_this.get_i(_this.timer.i + 1));
                        _this.f_timer();
                    }
                );
            }, 100);
        },

        on_resize: function () {
            var _this = this;
            jQuery(window)
                .resize(function () {
                    _this.do_resize();
                });
        },

        do_resize: function () {
            var _this = this;
            if (!_this.timout_id) {
                _this.timout_id = setTimeout(function () {
                    var _cw = _this.container.width();
                    if (_this.items.length && _cw < _this.items[0].width) {
                        _this.container
                            .find('.' + object_id + '-item')
                            .each(function (_i) {
                                var $this = jQuery(this);
                                $this.css({
                                    maxWidth: _cw + 'px',
                                    maxHeight: (_cw * _this.items[_i].ratio) + 'px'
                                });
                            });
                    } else {
                        _this.container
                            .find('.' + object_id + '-item')
                            .css({
                                maxWidth: '100%',
                                maxHeight: '100%'
                            })
                    }
                    clearTimeout(_this.timout_id);
                    _this.timout_id = 0;
                }, 200);
            }
        }
        ,
        /**
         *
         * @param _i
         * @returns {number|*}
         */
        get_i: function (_i) {
            _i = _i * 1;
            var _len = this.items.length - 1;
            if (_i > _len) {
                _i = 0
            } else if (_i < 0) {
                _i = _len;
            }
            if (!this.items[_i] || this.items[_i] == undefined) {
                _i = 0;
            }
            return _i;
        },

        /**
         *
         * @param _i
         * @returns {*}
         */
        next_i: function (_i) {
            this.timer.i = _i;
            var _pause = this.container.find('.' + object_id + '-item.item-' + _i).attr('item_pause') * 1.00;
            this.timer.pause = (_pause) ? _pause : 8000;
        }
        ,
        /**
         *
         */
        end: function () {
        }
    };

    return WidgetBanner;
})
();
