$(document).ready(function() {
    $('.dropdown-toggle').dropdown();

    $("#datatables").dataTable();

    /* 
        scripts for signup.php page
    */
    $('#signup_error_message').hide();

    $('#signup_first_name').blur(function() {
        if (!check_mandatory($(this))) {
            $('#signup_error_message span').text("Please enter your first name.");
            $('#signup_error_message').show();
        } else {
            $('#signup_error_message').hide();
        }
    });

    $('#signup_last_name').blur(function() {
        if (!check_mandatory($(this))) {
            $('#signup_error_message span').text("Please enter your last name.");
            $('#signup_error_message').show();
        } else {
            $('#signup_error_message').hide();
        }
    });

    $('#signup_email').blur(function() {
        if (!check_mandatory($(this))) {
            $('#signup_error_message span').text("Please enter your email.");
            $('#signup_error_message').show();
        } else if (!check_email_format($(this))) {
            $('#signup_error_message span').text("Please enter a valid email.");
            $('#signup_error_message').show();
        } else {
            $.ajax({
                url: 'includes/ajax.php',
                type: 'POST',
                data: {
                    'email_check': $(this).val()
                },
                success: function(data) {
                    if (data === "ok") {
                        $('#signup_error_message').hide();
                    } else {
                        $('#signup_error_message span').text("Email already exists.");
                        $('#signup_error_message').show();
                    }
                },
                error: function(xhr, desc, err) {
                    console.log(xhr);
                    console.log("Details: " + desc + "\nError:" + err);
                }
            });
        }
    });

    $('#signup_password').blur(function() {
        if (!check_mandatory($(this))) {
            $('#signup_error_message span').text("Please enter your password.");
            $('#signup_error_message').show();
        } else if (!check_password_strength($(this))) {
            $('#signup_error_message span').text("Password too weak. Minimum requirement: 1. at least 8 characters long; 2. contains both upper and lower case letters; 3. contains numbers; 4. contains at least one special character (!,%,&,@,#,$,^,*,?,_,~).");
            $('#signup_error_message').show();
        } else {
            $('#signup_error_message').hide();
        }
    });

    $('#signup_password_confirmation').blur(function() {
        if (!check_mandatory($(this))) {
            $('#signup_error_message span').text("Please enter your password again.");
            $('#signup_error_message').show();
        } else if (!check_password_consistance($(this), $('#signup_password'))) {
            $('#signup_error_message span').text("Password do not agree, please check again.");
            $('#signup_error_message').show();
        } else {
            $('#signup_error_message').hide();

        }
    });


    /*
        scripts for signin page
    */

    $('#signin_error_message').hide();

    /*
        scripts for company page
    */
    $('#add_favorate_btn').click(function() {
        //var sss=$('#company_symbol').html();
        //console.log(sss);
        $.ajax({
            url: 'includes/ajax.php',
            type: 'GET',
            data: {
                'company_symbol': $('#company_symbol').html()
            },
            success: function(data) {
                bootbox.alert("Added to your watchlist.");
            },
            error: function(xhr, desc, err) {
                console.log(xhr);
                console.log("Details: " + desc + "\nError:" + err);
            }
        });
    })

    /*
        Buy_stock_scripts for watchlist page
    */
    $('button[name^=buy_stock_btn]').click(function() {
        $.ajax({
            url: 'includes/ajax.php',
            type: 'GET',
            data: {
                'buy_company_symbol': $(this).parent().parent().find('[name=buy_company_symbol]').html(),
                'unit_price': $(this).parent().parent().find('[name=unit_price]').html(),
                'buy_ammount': $(this).prev().val()
            },

            success: function(data) {
                if (data == 'notEnoughBalance') {
                    bootbox.alert("You don't have enough balance.");
                } else if (data == 'ok') {
                    bootbox.alert("Transaction successful.");
                } else {
                    bootbox.alert("Transaction failed.");
                }
            },
            error: function(xhr, desc, err) {
                console.log(xhr);
                console.log("Details: " + desc + "\nError:" + err);
            }
        });

    })

    /*
        sell stock in portfolio
    */

    $('button[name^=sell_stock_btn]').click(function() {

        $.ajax({
            url: 'includes/ajax.php',
            type: 'GET',
            data: {
                'sell_stock_symbol': $(this).parent().parent().find('[name=sell_stock_symbol]').html(),
                'unit_price': $(this).parent().parent().find('[name=unit_price]').html(),
                'sell_shares': $(this).parent().parent().find('[name=sell_shares]').html(),
                'ammount': $(this).prev().val()

            },

            success: function(data) {
                if (data == 'notEnoughShares') {
                    bootbox.alert("You don't have enough shares to sell.");
                } else if (data == 'ok') {
                    bootbox.alert("Transaction successful.");
                } else {
                    bootbox.alert("Transaction failed.");
                }
            },
            error: function(xhr, desc, err) {
                console.log(xhr);
                console.log("Details: " + desc + "\nError:" + err);
            }
        });
    })


    /*
        Remove from watchlist
    */
    $('button[name^=remove_watchlist_btn]').click(function() {;
        $.ajax({
            url: 'includes/ajax.php',
            type: 'GET',
            data: {
                'remove_symbol': $(this).parent().parent().find('[name=buy_company_symbol]').html()
            },

            success: function(data) {
                if (data == 'ok') {
                    bootbox.alert("Remove successful.");
                } else {
                    bootbox.alert("Remove failed.");
                }

            },
            error: function(xhr, desc, err) {
                console.log(xhr);
                console.log("Details: " + desc + "\nError:" + err);
            }
        });
    })

});


function check_mandatory(element) {
    if (!element.val()) {
        return false;
    } else {
        return true;
    }
}

function check_email_format(element) {
    var r = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
    return (element.val().match(r) == null) ? false : true;
}

function check_password_strength(element) {
    var password = element.val();
    if (password.length < 8) {
        // at least 8 characters long
        return false;
    } else if (!password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
        // must contain both upper and lower case letters
        return false;
    } else if (!password.match(/([0-9])/)) {
        // must contain numbers
        return false;
    } else if (!password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
        // must contain at least one special character
        return false;
    } else {
        return true;
    }
}

function check_password_consistance(element1, element2) {
    if (element1.val() == element2.val()) {
        return true;
    } else {
        return false;
    }
}

function check_signup_table() {
    if ($('#signup_error_message').is(':visible')) {
        return false;
    } else {
        return true;
    }
}