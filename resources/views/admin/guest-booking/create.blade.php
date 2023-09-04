@extends('layouts.back-layout')
@section('content')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<style>
    .logo-container  {
        position: absolute;
        top: 1%;
        left: 3%;
        width: 10%;
        cursor: pointer;
        z-index: 100;
    }}

    /*custom font*/

    @import url(https://fonts.googleapis.com/css?family=Montserrat);

    /*basic reset*/

    * {
        margin: 0;
        padding: 0;
    }

    .card-body {
        height: 100%;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        background:#00a892;
        background-repeat:no-repeat;
        background-image: -webkit-gradient(linear, left top, left bottom, from(#00353b), to(#00a892));
        background-image: -webkit-linear-gradient(top, #61553b, #dad4c9);
        background-image: -moz-linear-gradient(top, #00353b, #00a892);
        background-image: -ms-linear-gradient(top, #00353b, #00a892);
        background-image: -o-linear-gradient(top, #00353b, #00a892);
        background-image: linear-gradient(top, #00353b, #00a892);
        filter: progid:DXImageTransform.Microsoft.gradient(start-colourStr='#00353b', end-colourStr='#00a892');


    }

    body {
        font-family: montserrat, arial, verdana;

    }

    .quantity{
        width: 30%;
    }


    /*form styles*/

    #msform {
        width: 700px;
        margin: 8px auto;
        text-align: center;
        position: relative;
    }

    #msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 3px;
        box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
        padding: 20px 30px;
        box-sizing: border-box;
        width: 80%;
        margin: 0 10%;
        /*stacking fieldsets above each other*/
        position: relative;
    }


    /*Hide all except first fieldset*/

    #msform fieldset:not(:first-of-type) {
        display: none;
    }


    /*inputs*/
    #msform .quantity{
        width: 20%;
    }

    #msform input,
    #msform textarea,
    #msform select {
        padding: 15px;
        border-radius: 3px;
        margin-bottom: 10px;
        width: 100%;
        box-sizing: border-box;
        font-family: montserrat;
        color: #2C3E50;
        font-size: 13px;
    }


    /*buttons*/

    #msform .action-button {
        width: 100px;
        background: #c2a569;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 1px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px;
    }

    #msform .action-button:hover,
    #msform .action-button:focus {
        box-shadow: 0 0 0 2px white, 0 0 0 3px rgba(161, 127, 58, 0.89);
    }


    /*headings*/

    .fs-title {
        font-size: 15px;
        text-transform: uppercase;
        color: #2C3E50;
        margin-bottom: 10px;
    }

    .fs-subtitle {
        font-weight: normal;
        font-size: 13px;
        color: #666;
        margin-bottom: 20px;
        text-align: left;
    }


    /*progressbar*/

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        /*CSS counters to number the steps*/
        counter-reset: step;
    }

    #progressbar ul {
        padding-left:0px !important;
    }

    #progressbar li {
        list-style-type: none;
        color: white;
        text-transform: uppercase;
        font-size: 9px;
        width:50%;
        float: left;
        position: relative;
    }

    #progressbar li:before {
        content: counter(step);
        counter-increment: step;
        width: 20px;
        line-height: 20px;
        display: block;
        font-size: 10px;
        color: #333;
        background: white;
        border-radius: 3px;
        margin: 0 auto 5px auto;
    }


    /*progressbar connectors*/

    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: white;
        position: absolute;
        left: -50%;
        top: 9px;
        z-index: -1;
        /*put it behind the numbers*/
    }

    #progressbar li:first-child:after {
        /*connector not needed before the first step*/
        content: none;
    }


    /*marking active/completed steps green*/


    /*The number of the step and the connector before it = green*/

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: rgba(253, 225, 159, 0.68);
        color: #5e4b23;
    }

    .error{
        display: none;
        margin-left: 10px;
    }

    .error_show{
        color: red;
        margin-left: 10px;
    }

    input.invalid{
        border: 2px solid red;
    }

    input.valid, textarea.valid{
        border: 2px solid green;
    }
</style>

    <style>
        input-wrapper {
            width: 150px;
            height: 30px;
            display: flex;
            border-radius: 50%;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
            padding: 10px;
            text-align: center;
        }

        .input-wrapper * {
            border: none;
            width: 50px;
            flex: 1;
        }

        .input-wrapper button {
            cursor: pointer;
        }

        .input-wrapper button:first-child {
            border-radius: 50% 0 0 50%;
            color: red;
        }

        .input-wrapper button:last-child {
            border-radius: 0 50% 50% 0;
            color: green;
        }

    </style>

@endpush

<div class="card-body">
    <form id="msform" class="form"
          action="{{route('admin.guest-booking.store')}}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <!-- progressbar -->
        <ul id="progressbar">
            <li class="active">Your Details</li>
            <li>Choose your room</li>
        </ul>
        <!-- fieldsets -->

        <fieldset>

            <h2 class="fs-title">Personal Details</h2>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="projectinput1"> First Name </label>
                        <input type="text" id="firstName"
                               class="form-control"
                               placeholder=" "
                               value="{{ old('firstName') }}"
                               name="firstName">
                        @error("firstName")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="projectinput1"> Last Name </label>
                        <input type="text" id="lastName"
                               class="form-control"
                               placeholder=" "
                               value="{{ old('lastName') }}"
                               name="lastName">
                        @error("lastName")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="projectinput1"> Email </label>
                        <input type="text"
                               id="email"
                               placeholder=" "
                               value="{{ old('email') }}"
                               name="email">
                        <span class="error">A valid email address is required</span>

                    @error("email")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>                                                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="projectinput1"> Phone </label>
                        <input type="text" id="phone"
                               class="form-control"
                               placeholder=" "
                               value="{{ old('phone') }}"
                               name="phone">
                        @error("phone")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="projectinput1"> Check In </label>
                        <input type="text" name="check_in" class="datepicker form-control">                                                             @error("checkInDate")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="projectinput1"> Check Out </label>
                        <input type="text" name="check_out" class="datepicker form-control">                                                             @error("checkInDate")
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <input type="button" name="next" class="next action-button" value="Next" />

        </fieldset>

        <fieldset>

            <h2 class="fs-title">Choose your room</h2>
            <h3 class="fs-subtitle">Choose room type and quantity</h3>
            <div class="row mt-1" id="activities-container">
                <div class="col-md-5">
                    <div class="form-group">
                        <select class="js-example-basic-single" name="rooms[]">
                            @foreach($rooms as $room)
                                @php
                                    $availableCount = $room->roomwithnumber->where('available', 1)->count();
                                @endphp
                                <option value="{{$room->id}}">({{$availableCount}}) {{$room->room_type}} </option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="col-md-5">
                    <span class="input-wrapper">
                        <button type="button" id="decrement">-</button>
                        <input type="number"  min="1" max="10" name="quantity[]" value="1" class="quantity" />
                        <button type="button" class="increment">+</button>
                    </span>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary add-activity">more</button>
                        </div>
                    </div>
                </div>
            </div>
            <input type="button" name="previous" class="previous action-button" value="Previous" />
            <input type="submit" name="submit" class="submit action-button" value="Submit" />

        </fieldset>

    </form>
</div>

@stop

@push('scripts')



    <script>
        $(document).ready(function() {
            console.log('ok')
            // Function to add a new activity input field
            function addActivityInput() {
                var activityInput = `

            <div class="row mt-2">
                  <div class="col-md-5">
                       <div class="form-group">
                              <select class="js-example-basic-single" name="rooms[]">
                                   @foreach($rooms as $room)
                                    <option value="{{$room->id}}">({{$availableCount}}) {{$room->room_type}}</option>
                                    @endforeach
                                </select>
                             </div>
                        </div>
                        <div class="col-md-5">
                             <span class="input-wrapper">
                                  <button type="button" id="decrement">-</button>
                                  <input type="number"  name="quantity[]" value="1" min="1" max="10" class="quantity" />
                                  <button type="button" class="increment">+</button>
                             </span>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                            <button type="button" class="btn btn-light remove-activity">X</button>
                            </div>
                        </div>
                    </div>

                    `;

                $('#activities-container').append(activityInput);
            }

            // Add Activity button click event
            $('.add-activity').click(function() {
                console.log('add')
                addActivityInput();
            });

            // Remove Activity button click event
            $(document).on('click', '.remove-activity', function() {
                console.log('remove')
                $(this).closest('.row').remove();
            });
        });
    </script>


    <script>
        $('input:radio[name="type"]').change(
            function(){
                if (this.checked && this.value == '2') {  // 1 if main cat - 2 if sub cat
                    $('#cats_list').removeClass('hidden');

                }else{
                    $('#cats_list').addClass('hidden');
                }
            });
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $( function() {
            $( ".datepicker" ).datepicker();
        } );
    </script>

    <script>

        //jQuery time
        var current_fs, next_fs, previous_fs; //fieldsets
        var left, opacity, scale; //fieldset properties which we will animate
        var animating; //flag to prevent quick multi-click glitches

        $(".next").click(function(){
            if(animating) return false;
            animating = true;

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //activate next step on progressbar using the index of next_fs
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale current_fs down to 80%
                    scale = 1 - (1 - now) * 0.2;
                    //2. bring next_fs from the right(50%)
                    left = (now * 50)+"%";
                    //3. increase opacity of next_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({
                        'transform': 'scale('+scale+')',
                        'position': 'absolute'
                    });
                    next_fs.css({'left': left, 'opacity': opacity});
                },
                duration: 800,
                complete: function(){
                    current_fs.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        });

        $(".previous").click(function(){
            if(animating) return false;
            animating = true;

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //de-activate current step on progressbar
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale previous_fs from 80% to 100%
                    scale = 0.8 + (1 - now) * 0.2;
                    //2. take current_fs to the right(50%) - from 0%
                    left = ((1-now) * 50)+"%";
                    //3. increase opacity of previous_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({'left': left});
                    previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
                },
                duration: 800,
                complete: function(){
                    current_fs.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        });

    </script>
<script>
    $(document).ready(function() {
        //Detect that a user has started entering their name itno the name input
        // Name can't be blank
        function validateInput(inputElement) {
            var input = $(inputElement);
            var is_value = input.val();
            if (is_value) {
                input.removeClass("invalid").addClass("valid");
            } else {
                input.removeClass("valid").addClass("invalid");
            }
        }

// Use the validateInput function for both firstName and lastName fields
        $('#firstName').on('input', function() {
            validateInput(this);
        });

        $('#lastName').on('input', function() {
            validateInput(this);
        });


// Email must be an email
        $('#email').on('input', function() {
            console.log('email')
            var input=$(this);
            var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            var is_email=re.test(input.val());
            if(is_email){input.removeClass("invalid").addClass("valid");}
            else{input.removeClass("valid").addClass("invalid");}
        });

        // Phone number validation regular expression (adjust as needed)
        var phoneRegex = /^\d{11}$/;

// Validation for the phone field
        $('#phone').on('input', function() {
            var input = $(this);
            var is_phone = input.val();
            if (phoneRegex.test(is_phone)) {
                input.removeClass("invalid").addClass("valid");
            } else {
                input.removeClass("valid").addClass("invalid");
            }
        });

// After Form Submitted Validation
        $("#contact_submit button").click(function(event){
            var form_data=$("#contact").serializeArray();
            var error_free=true;
            for (var input in form_data){
                var element=$("#contact_"+form_data[input]['name']);
                var valid=element.hasClass("valid");
                var error_element=$("span", element.parent());
                if (!valid){error_element.removeClass("error").addClass("error_show"); error_free=false;}
                else{error_element.removeClass("error_show").addClass("error");}
            }
            if (!error_free){
                event.preventDefault();
            }
            else{
                alert('No errors: Form will be submitted');
            }
        });
    });


</script>

    <script>
        const incrementButton = document.querySelector(".increment");
        const decrementButton = document.querySelector("#decrement");
        const quantityInput = document.querySelector(".quantity");
        const maxAvailable = parseInt(quantityInput.getAttribute("max"));

        incrementButton.addEventListener("click", () => {
            let newValue = parseInt(quantityInput.value) + 1;
            if (newValue <= maxAvailable) {
                quantityInput.value = newValue;
            }
        });

        decrementButton.addEventListener("click", () => {
            let newValue = parseInt(quantityInput.value) - 1;
            if (newValue >= 1) {
                quantityInput.value = newValue;
            }
        });
    </script>

@endpush
