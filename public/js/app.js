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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/app.js":
/*!************************************!*\
  !*** ./resources/assets/js/app.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
* First we will load all of this project's JavaScript dependencies which
* includes Vue and other libraries. It is a great starting point when
* building robust, powerful web applications using Vue and Laravel.
*/
$(document).ready(function () {
  $('#ContractDownload form').submit(function (e) {
    e.preventDefault();
    var url = $(this).attr('action');
    $.ajax({
      url: url,
      type: 'POST',
      success: function success(data) {
        $('#ContractDownload .modal-footer button').text('Оплачено');
        setTimeout(function () {
          var link = document.createElement("a");
          link.download = name;
          link.href = '/uploads/contracts/' + data;
          link.click();
          $('#ContractDownload').modal('hide');
        }, 1000);
      }
    });
  });
  $(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
  $('#profile_link').click(function (e) {
    e.preventDefault();
  });
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('#urgent_consultation_order').click(function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    var lawyer_id = $(this).attr('data-id');
    $.ajax({
      method: "POST",
      url: url,
      data: {
        'lawyer_id': lawyer_id
      },
      success: function success(response) {
        $('#urgent_lawyer_id').val(lawyer_id);
        $('#urgentConsultationModal .specialist.name .value').html(response.lawyer_fullname);
        $('#urgentConsultationModal .specialist.price .amount').html(response.lawyer_price);
      }
    });
  });
  $('#urgentConsultationModal form').submit(function (e) {
    e.preventDefault();
    var url = $(this).attr('action');
    var form = $(this);
    var html = '';
    $.ajax({
      method: "POST",
      url: url,
      data: form.serialize(),
      beforeSend: function beforeSend() {
        $('#urgentConsultationModal .modal-body *').hide();
        $('#urgentConsultationModal .modal-body').append('<div class="lds-facebook"><div></div><div></div><div></div></div>');
      },
      success: function success(response) {
        form.hide();
        setTimeout(function () {
          $('#urgentConsultationModal .modal-body *').show();
          $('#urgentConsultationModal .modal-body form').hide();
          $('#urgentConsultationModal .modal-body .lds-facebook').remove();
        }, 300);
        html += "<h4 class='alert alert-success text-center'>Ваша заявка успешно отправлена!</h4> <h5 class='alert alert-light text-center'>В ближайшее время с вами свяжется специалист.</h5>";
        $('#urgentConsultationModal .modal-body .messages').html(html);
      }
    });
  });
  $('#applicationConsultationModal form').submit(function (e) {
    var _this = this;

    e.preventDefault();
    var url = $(this).attr('action');
    var form = $(this);
    var formData = new FormData(this);
    var html = '';
    $.ajax({
      type: 'POST',
      url: url,
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function beforeSend() {
        $('#applicationConsultationModal .modal-body *').hide();
        $('#applicationConsultationModal .modal-body').append('<div class="lds-facebook"><div></div><div></div><div></div></div>');
      },
      success: function success(data) {
        setTimeout(function () {
          $('#applicationConsultationModal .modal-body .messages').show();
          $('#applicationConsultationModal .modal-body .lds-facebook').remove();
        }, 300);

        _this.reset();

        form.hide();
        html += "<h4 class='alert alert-success text-center'>Ваша заявка успешно отправлена!</h4> <h5 class='alert alert-light text-center'>В ближайшее время с вами свяжется специалист.</h5>";
        $('#applicationConsultationModal .modal-body .messages').html(html);
      },
      error: function error(data) {
        var respJson = data.responseJSON;
        var errors = respJson.errors;
        var errorBlock = '';
        errorBlock += '<div class="alert alert-danger"><ul>';
        $.each(errors, function (i, error) {
          errorBlock += '<li>' + error[0] + '</li>';
        });
        errorBlock += '</ul></div>';
        $('#applicationConsultationModal .messages').html(errorBlock);
        setTimeout(function () {
          $('#applicationConsultationModal .modal-body *').show();
          $('#applicationConsultationModal .modal-body .lds-facebook').remove();
        }, 300);
      }
    }).done(function (data) {});
  });
  $('#applicationConsultationModal').on('hidden.bs.modal', function () {
    $('#applicationConsultationModal form').show();
    $('#applicationConsultationModal .modal-body .messages').html("");
    $('#applicationConsultationModal .modal-body *').show();
  });
  $('#urgentConsultationModal').on('hidden.bs.modal', function () {
    $('#urgentConsultationModal form').show();
    $('#urgentConsultationModal .modal-body .messages').html("");
    $('#urgentConsultationModal .modal-body *').show();
  });
  $(document).on('click', '.content-online_consultations .detail', function (event) {
    event.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
      url: url,
      type: "get",
      dataType: "html",
      beforeSend: function beforeSend() {
        $('#consultationFileModal .modal-body').empty().append('<div class="lds-facebook"><div></div><div></div><div></div></div>');
      }
    }).done(function (data) {
      $('#consultationFileModal .modal-body').empty().html(data);
    }).fail(function (jqXHR, ajaxOptions, thrownError) {
      alert('Проблемы с соединением, обновите страницу');
    });
    $("#consultationFileModal").modal('show');
  });
  $(document).on('click', '.content-urgent_consultations .description', function (event) {
    event.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
      url: url,
      type: "get",
      dataType: "html",
      beforeSend: function beforeSend() {
        $('#urgentModal .modal-body').empty().append('<div class="lds-facebook"><div></div><div></div><div></div></div>');
      }
    }).done(function (data) {
      setTimeout(function () {
        $('#urgentModal .modal-body').empty().html(data);
      }, 300);
    }).fail(function (jqXHR, ajaxOptions, thrownError) {
      alert('Проблемы с соединением, обновите страницу');
    });
    $("#urgentModal").modal('show');
  });
  $(document).on('click', '.content-urgent_consultations .conclusion', function (event) {
    event.preventDefault();
    var id = $(this).attr('data-id');
    var url = $(this).attr('href');
    console.log(url);
    $.ajax({
      url: url,
      type: "get",
      dataType: "html",
      beforeSend: function beforeSend() {
        $('#urgentConclusionModal .modal-body *').hide();
        $('#urgentConclusionModal .modal-body').append('<div class="lds-facebook"><div></div><div></div><div></div></div>');
      }
    }).done(function (data) {
      $.getScript('js/dynamic.js');
      setTimeout(function () {
        $('#urgentConclusionModal .modal-body *').show();
        $('#urgentConclusionModal .modal-body .lds-facebook').remove();
      }, 300);
      $('#urgentConclusionModal .modal-body').html(data);
    }).fail(function (jqXHR, ajaxOptions, thrownError) {
      alert('Проблемы с соединением, обновите страницу');
    });
  });
  $(document).on('click', '#urgentConclusionModal form .save', function (e) {
    e.preventDefault();
    var url = $(this).attr('action');
    var form = $(this).parents('form');
    var id = $('#urgent_id').val();
    $.ajax({
      type: 'POST',
      url: form.attr('action'),
      data: form.serialize(),
      beforeSend: function beforeSend() {
        $('#urgentConclusionModal .modal-body *').hide();
        $('#urgentConclusionModal .modal-body').append('<div class="lds-facebook"><div></div><div></div><div></div></div>');
      },
      success: function success(data) {
        setTimeout(function () {
          $('#urgentConclusionModal .modal-body *').show();
          $('#urgentConclusionModal .modal-body .lds-facebook').remove();
        }, 300);
        $('#urgentConclusionModal .modal-body').html(data);
        $('#urgentConclusionModal .modal-footer .messages').remove();
        $('#urgentConclusionModal .modal-footer').prepend('<div class="messages col">Сохранено</div>');
        setTimeout(function () {
          $('#urgentConclusionModal .modal-footer .messages').remove();
        }, 1000);
        $.getScript('js/dynamic.js');
      },
      error: function error(data) {
        console.log(data);
      }
    }).done(function (data) {
      console.log(data);
    });
  });
  $(document).on('click', '.content-application_consultations .description', function (event) {
    event.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
      url: url,
      type: "get",
      beforeSend: function beforeSend() {
        $('#ApplicationModal .modal-body').empty().append('<div class="lds-facebook"><div></div><div></div><div></div></div>');
      },
      dataType: "html"
    }).done(function (data) {
      setTimeout(function () {
        $('#ApplicationModal .modal-body').empty().html(data);
      }, 300);
    }).fail(function (jqXHR, ajaxOptions, thrownError) {
      alert('Проблемы с соединением, обновите страницу');
    });
    $("#ApplicationModal").modal('show');
  });
  $(document).on('click', '.content-application_consultations .coming .conclusion', function (event) {
    event.preventDefault();
    var id = $(this).attr('data-id');
    $('#application_id').val(id);
    var url = $(this).attr('href');
    $.ajax({
      url: url,
      type: "get",
      dataType: "html",
      beforeSend: function beforeSend() {
        $('#ApplicationConclusionModal .modal-body *').hide();
        $('#ApplicationConclusionModal .modal-body').append('<div class="lds-facebook"><div></div><div></div><div></div></div>');
      }
    }).done(function (data) {
      $.getScript('js/dynamic.js');
      setTimeout(function () {
        $('#ApplicationConclusionModal .modal-body *').show();
        $('#ApplicationConclusionModal .modal-body .lds-facebook').remove();
      }, 300);
      $('#ApplicationConclusionModal .modal-body').html($(data));
    }).fail(function (jqXHR, ajaxOptions, thrownError) {
      alert('Проблемы с соединением, обновите страницу');
    });
  });
  $(document).on('click', '.content-application_consultations .completed .conclusion', function (event) {
    event.preventDefault();
    var id = $(this).attr('data-id');
    $('#application_id').val(id);
    var url = $(this).attr('href');
    $.ajax({
      url: url,
      type: "get",
      dataType: "html",
      beforeSend: function beforeSend() {
        $('#ApplicationConclusionGetModal .modal-body *').hide();
        $('#ApplicationConclusionGetModal .modal-body').append('<div class="lds-facebook"><div></div><div></div><div></div></div>');
      }
    }).done(function (data) {
      $.getScript('js/dynamic.js');
      setTimeout(function () {
        $('#ApplicationConclusionGetModal .modal-body *').show();
        $('#ApplicationConclusionGetModal .modal-body .lds-facebook').remove();
      }, 300);
      $('#ApplicationConclusionGetModal .modal-body').html($(data));
    }).fail(function (jqXHR, ajaxOptions, thrownError) {
      alert('Проблемы с соединением, обновите страницу');
    });
  });
  $(document).on('click', '#ApplicationConclusionModal form .save', function (e) {
    e.preventDefault();
    var url = $(this).parents('form').attr('action');
    var form = $(this).parents('form');
    var id = $('#application_id').val();
    console.log('click');
    $.ajax({
      type: 'POST',
      url: form.attr('action'),
      data: form.serialize(),
      beforeSend: function beforeSend() {
        $('#ApplicationConclusionModal .modal-body *').hide();
        $('#ApplicationConclusionModal .modal-body').append('<div class="lds-facebook"><div></div><div></div><div></div></div>');
      },
      success: function success(data) {
        setTimeout(function () {
          $('#ApplicationConclusionModal .modal-body *').show();
          $('#ApplicationConclusionModal .modal-body .lds-facebook').remove();
        }, 300);
        $('#ApplicationConclusionModal .modal-footer .messages').remove();
        $('#ApplicationConclusionModal .modal-footer').prepend('<div class="messages col">Сохранено</div>');
        setTimeout(function () {
          $('#ApplicationConclusionModal .modal-footer .messages').remove();
          $('#ApplicationConclusionModal').modal('hide');
        }, 1000);
      },
      error: function error(data) {}
    }).done(function (data) {});
  });
  $('#order').on('click', function () {
    $(this).hide();
    $('#onlineConsultationModal form').each(function () {
      var _this2 = this;

      var url = $(this).attr('action');
      var formData = new FormData(this);
      $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function success(data) {
          _this2.reset();

          $('#onlineConsultationModal form .error').remove();
          $('#onlineConsultationModal .modal-body #descr_text').remove();
          $('#onlineConsultationModal .modal-body').append("<h4 id='descr_text' class='text-center'>Вы успешно записались!</h4>");
          setTimeout(function () {
            window.location.href = "/online_consultations";
          }, 800);
        },
        error: function error(data) {
          var respJson = data.responseJSON;
          var errors = respJson.errors;
          var errorBlock = '';
          errorBlock += '<div class="alert alert-danger"><ul>';
          $.each(errors, function (i, error) {
            errorBlock += '<li>' + error[0] + '</li>';
          });
          errorBlock += '</ul></div>';
          $('#onlineConsultationModal .messages').html(errorBlock);
          $('#order').show();
        }
      }).done(function (data) {
        $('#order').hide();
      });
    });
  });
  $(document).on('click', '.content-application_consultations .detail', function (event) {
    event.preventDefault();
    var id = $(this).attr('data-id');
    var url = $(this).attr('href');
    console.log(url);
    $.ajax({
      url: url,
      type: "get",
      dataType: "html",
      beforeSend: function beforeSend() {
        $('#ApplicationDetailModal .modal-body').empty().append('<div class="lds-facebook"><div></div><div></div><div></div></div>');
      }
    }).done(function (data) {
      setTimeout(function () {
        $('#ApplicationDetailModal .modal-body').empty().html(data);
      }, 300);
    }).fail(function (jqXHR, ajaxOptions, thrownError) {
      alert('Проблемы с соединением, обновите страницу');
    });
  });
  $('.headers .search-cta').click(function () {
    $(this).toggleClass('active');
    $(this).parents('li').find('.search_form').toggleClass('active');
  });
  $('.switch_wrapper .input-container').each(function () {
    if ($(this).find('input').is(':checked')) {
      $(this).addClass('checked');
      var value = $(this).find('input').val();
      console.log(value);

      if (value == 'client') {
        $('#lawyer_docs_group').addClass('hidden');
      }

      if (value == 'lawyer') {
        $('#lawyer_docs_group').removeClass('hidden');
      }
    }
  });
  $('.switch_wrapper .radio-button').click(function () {
    if ($('.switch_wrapper .input-container input').attr('checked', true)) {
      $('.switch_wrapper .input-container').removeClass('checked');
    }

    $(this).parents('.input-container').addClass('checked');
    var value = $(this).val();

    if (value == 'client') {
      $('#lawyer_docs_group').addClass('hidden');
    }

    if (value == 'lawyer') {
      $('#lawyer_docs_group').removeClass('hidden');
    }
  });
});
$(window).scroll(function () {
  var $this = $(this);

  if ($this.scrollTop() > 20) {
    $('a#zayavka').show();
  } else {
    $('a#zayavka').hide();
  }
});

/***/ }),

/***/ "./resources/assets/sass/app.scss":
/*!****************************************!*\
  !*** ./resources/assets/sass/app.scss ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/assets/sass/calendar.scss":
/*!*********************************************!*\
  !*** ./resources/assets/sass/calendar.scss ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*****************************************************************************************************************!*\
  !*** multi ./resources/assets/js/app.js ./resources/assets/sass/app.scss ./resources/assets/sass/calendar.scss ***!
  \*****************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\OSPanel\domains\urist\resources\assets\js\app.js */"./resources/assets/js/app.js");
__webpack_require__(/*! C:\OSPanel\domains\urist\resources\assets\sass\app.scss */"./resources/assets/sass/app.scss");
module.exports = __webpack_require__(/*! C:\OSPanel\domains\urist\resources\assets\sass\calendar.scss */"./resources/assets/sass/calendar.scss");


/***/ })

/******/ });