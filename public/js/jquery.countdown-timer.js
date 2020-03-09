/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 9);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/jquery.countdown-timer.js":
/*!*******************************************************!*\
  !*** ./resources/assets/js/jquery.countdown-timer.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function ($) {
  // test  _countdown_now=20xx/xx/xx.xx:xx
  var testNowMatch = window.location.href.match(/(?:\?|&)_countdown_now=([^&]+)/);
  var debugAddTime = testNowMatch ? new Date(testNowMatch[1].replace('.', ' ')).getTime() - new Date().getTime() : 0;
  var timeUnit = {
    day: 24 * 60 * 60 * 1000,
    hour: 60 * 60 * 1000,
    min: 60 * 1000,
    sec: 1000,
    ms: 1
  };
  var limiterTimeUnit = {
    day: timeUnit.day / timeUnit.hour,
    hour: timeUnit.hour / timeUnit.min,
    min: timeUnit.min / timeUnit.sec,
    sec: timeUnit.sec / timeUnit.ms,
    ms: null
  };
  var renderId = 0;
  var timeEvent = $('<div>');
  var timeCounterList = {};
  var timeSegmentList = {};

  var getRenderId = function getRenderId() {
    return ++renderId;
  };

  var initEl = function initEl($el) {
    var html = $el.html();
    var limiterUnit = '';
    $.each(['day', 'hour', 'min', 'sec', 'ms'], function () {
      var unit = this;
      var re = new RegExp('{' + unit + '(?::(0+))?}');

      if (html.match(re)) {
        html = html.replace(re, '<span class="countdown-timer countdown-timer-' + unit + '"' + ' data-countdown-timer-unit="' + unit + '"' + ' data-countdown-timer-zero="$1"' + ' data-countdown-timer-limiter="' + limiterUnit + '"></span>');
        limiterUnit = limiterTimeUnit[unit];
      }
    });
    $el.html(html);
  };

  var renderEl = function renderEl($el, countdownTime) {
    $el.find('span.countdown-timer').each(function (index, el) {
      var $el = $(el);
      timeEvent.on('render-' + countdownTime + '-' + $el.data('countdown-timer-unit') + '.' + renderId, function (e, time) {
        var unit = $el.data('countdown-timer-unit');
        var limiter = $el.data('countdown-timer-limiter');
        var zero = $el.data('countdown-timer-zero') + '';
        if (limiter > 0) time = time % limiter;

        if (unit == 'ms') {
          time = ('00' + time).slice(-3);
          if (zero.length) time = time.slice(0, zero.length);
        } else {
          if ((time + '').length < zero.length) time = (Array(zero.length).join('0') + time).slice(-zero.length);
        }

        $el.text(time);
      });
    });
  };

  var resetTimeSegment = function resetTimeSegment(countdownTime) {
    timeSegmentList[countdownTime] = {
      day: null,
      hour: null,
      min: null,
      sec: null,
      ms: null
    };
  };

  var timeCounter = function timeCounter(countdownTime) {
    resetTimeSegment(countdownTime);
    if (countdownTime in timeCounterList) return;
    timeCounterList[countdownTime] = true;
    var start = false;
    var intervalId = setInterval(function () {
      var now = new Date();
      if (debugAddTime) now.setTime(now.getTime() + debugAddTime); // debug

      var diffTime = countdownTime - now;
      if (diffTime < 0) diffTime = 0;
      $.each(['day', 'hour', 'min', 'sec', 'ms'], function () {
        var unit = this;
        var time = Math.floor(diffTime / timeUnit[unit]);

        if (timeSegmentList[countdownTime][unit] !== time) {
          timeSegmentList[countdownTime][unit] = time;
          timeEvent.trigger('render-' + countdownTime + '-' + unit, time);
        }
      });

      if (diffTime == 0) {
        clearInterval(intervalId);
        delete timeCounterList[countdownTime];
        timeEvent.trigger('end-' + countdownTime);
      }
    }, 10);
  };

  $.fn.countdownTimer = function (end, endFunction) {
    var countdownTime = new Date(end).getTime();
    this.each(function (index, el) {
      var $el = $(el);
      var renderId = getRenderId();

      if ($el.data('countdown-timer-render-id')) {
        timeEvent.off('.' + $el.data('countdown-timer-render-id'));
        $el.off('.' + $el.data('countdown-timer-render-id'));
      }

      $el.data('countdown-timer-render-id', renderId);
      initEl($el);
      renderEl($el, countdownTime);
      $.each(['day', 'hour', 'min', 'sec', 'ms'], function () {
        var unit = this;
        timeEvent.on('render-' + countdownTime + '-' + unit + '.' + renderId, function (e, time) {
          $el.trigger('countdownTimer:render-' + unit, time);
        });
      });
      timeEvent.on('end-' + countdownTime + '.' + renderId, function (e) {
        timeEvent.off('.' + renderId);
        $el.trigger('countdownTimer:end');
      });

      if (typeof endFunction == 'function') {
        $el.on('countdownTimer:end.' + renderId, endFunction);
      }
    });
    timeCounter(countdownTime);
    return this;
  };
})(jQuery);

/***/ }),

/***/ 9:
/*!*************************************************************!*\
  !*** multi ./resources/assets/js/jquery.countdown-timer.js ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\OSPanel\domains\1430.kz.new_design\resources\assets\js\jquery.countdown-timer.js */"./resources/assets/js/jquery.countdown-timer.js");


/***/ })

/******/ });