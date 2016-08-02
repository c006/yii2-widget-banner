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
        this.items = [];
        this.timer = {duration: 0, i: -1, last: -1, trans: 'left', easing: 'linear', item: {}};
        this.timout_id = 0;

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

            _this.on_resize();

            var $container = jQuery(this.container_id);

            _this.timer = {
                duration: $container.attr('item_duration'),
                transition: $container.attr('item_transition'),
                easing: $container.attr('item_type'),
                pause: 0,
                item: {}
            };

            $container
                .find('.' + object_id + '-item')
                .each(function () {
                    var $this = jQuery(this);
                    _this.items.push({
                        pause: $this.attr('item_pause'),
                        ratio: $this.attr('item_ratio'),
                        width: $this.find('img').width()
                    });
                });


            var $banner = jQuery('.' + object_id + '-item[item_on=1]');
            $banner.appendTo(_this.container_id);

            switch (this.timer.transition) {
                case 'Fade':
                    $container.find('.' + object_id + '-item').addClass('absolute');
                    jQuery('.' + object_id + '-item[item_on=1]').removeClass('absolute');

                    _this.f_fade(0);
                    break;
                case 'Slide Left':
                    $container.find('.' + object_id + '-item').addClass('absolute').css({opacity: 1});
                    jQuery('.' + object_id + '-item[item_on=1]').removeClass('absolute');
                    _this.f_slide_left(0);
                    break;
                case 'Slide Right':
                    $container.find('.' + object_id + '-item').addClass('absolute').css({opacity: 1});
                    jQuery('.' + object_id + '-item[item_on=1]').removeClass('absolute');
                    _this.f_slide_right(0);
                    break;
            }
        },

        /**
         *
         * @param _i
         */
        f_fade: function (_i) {
            var _this = this;
            _i = _this.get_i(_i);
            var _pause = (_this.items.length) ? _this.items[_i].pause : 5000;
            setTimeout(function () {
                var $banner = jQuery('.' + object_id + '-item[item_id=' + _i + ']');
                $banner.appendTo(_this.container_id);
                $banner.animate(
                    {opacity: 1},
                    _this.timer.duration * 1.00,
                    "" + _this.timer.easing,
                    function () {
                        var $item = jQuery('.' + object_id + '-item[item_on=1]');
                        $item.css({opacity: 0}).attr('item_on', '0');
                        $banner.attr('item_on', '1');
                    }
                );
                _this.f_fade(_i);
            }, _pause);
        },

        /**
         *
         * @param _i
         */
        f_slide_left: function (_i) {
            var _this = this;
            _i = _this.get_i(_i);
            setTimeout(function () {
                var $banner = jQuery('.' + object_id + '-item[item_id=' + _i + ']');
                $banner.appendTo(_this.container_id);
                var $img = $banner.find('> img');
                $img.css({top: -($img.height() * 1) + 'px', left: ($img.width() * 1) + 'px'});
                $img
                    .animate(
                    {left: 0},
                    _this.timer.duration * 1.00,
                    "" + _this.timer.easing,
                    function () {
                        var $item = jQuery('.' + object_id + '-item[item_on=1]');
                        $item.attr('item_on', '0').addClass('absolute');
                        $banner.attr('item_on', '1').removeClass('absolute');
                        $img.css({top: 0});
                    }
                );

                _this.f_slide_left(_i);
            }, _this.items[_i].pause);
        },

        /**
         *
         * @param _i
         */
        f_slide_right: function (_i) {
            var _this = this;
            _i = _this.get_i(_i);
            setTimeout(function () {
                var $banner = jQuery('.' + object_id + '-item[item_id=' + _i + ']');
                $banner.appendTo(_this.container_id);
                var $img = $banner.find('> img');
                $img.css({top: -($img.height() * 1) + 'px', left: -($img.width() * 1) + 'px'});
                $img
                    .animate(
                    {left: 0},
                    _this.timer.duration * 1.00,
                    "" + _this.timer.easing,
                    function () {
                        var $item = jQuery('.' + object_id + '-item[item_on=1]');
                        $item.attr('item_on', '0').addClass('absolute');
                        $banner.attr('item_on', '1').removeClass('absolute');
                        $img.css({top: 0});
                    }
                );

                _this.f_slide_right(_i);
            }, _this.items[_i].pause);
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
                    var $container = jQuery(_this.container_id);
                    var _cw = $container.width();
                    if (_this.items.length && _cw < _this.items[0].width) {
                        $container
                            .find('.' + object_id + '-item')
                            .each(function (_i) {
                                var $this = jQuery(this);
                                $this.css({
                                    maxWidth: _cw + 'px',
                                    maxHeight: (_cw * _this.items[_i].ratio) + 'px'
                                });
                            });
                    } else {
                        $container
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
        },

        /**
         *
         * @param _i
         * @returns {*}
         */
        get_i: function (_i) {
            _i++;
            if (_i == undefined || _i >= jQuery('.' + object_id + '-item').length) {
                _i = 0;
            }
            return _i;
        },
        end: function () {
        }
    };

    return WidgetBanner;
})();
