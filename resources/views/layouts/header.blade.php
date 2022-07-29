<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name')}}</title>
    <link rel="stylesheet" href="<?php echo URL::to('assets\css\materialdesignicons.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo URL::to('assets\css\style.css'); ?>" />
    <link rel="stylesheet" href="<?php echo URL::to('assets\css\toastr.min.css'); ?>" />
    <link rel="shortcut icon" href="<?php echo URL::to('assets\images\favicon.png'); ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo URL::to('assets\css\select2-bootstrap.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo URL::to('assets\css\dataTables.bootstrap.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo URL::to('assets\css\buttons.bootstrap.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo URL::to('assets\css\sweetalert2.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo URL::to('assets\css\theme.css'); ?>" />
    <link rel="stylesheet" href="<?php echo URL::to('assets\css\custome.css'); ?>" />
    <link rel="stylesheet" href="<?php echo URL::to('assets\css\daterangepicker.css'); ?>" />
    
    <script src="<?php echo URL::to('assets\js\jquery.min.js'); ?>" crossorigin="anonymous"></script>
    <script src="<?php echo URL::to('assets\js\jquery.validate.js'); ?>"></script>  
    <script>
      var dataTableConfigObj;
        dataTableConfigObj = {
            "oLanguage": {
                "sZeroRecords": "No records to display",
                "sSearch": "Search : ",
                "sLengthMenu": "Show Records : _MENU_ "
            },
            "ajax": {
                "type": "GET"
            },
            "iDisplayLength": 10,
            "aLengthMenu": [
                [10, 25, 50, 100, 500],
                [10, 25, 50, 100, 500]
            ],
            "bProcessing": false,
            "bServerSide": true,
            "bPaginate": true,
            "searchDelay": 1000,
            "sAjaxSource": "",
            "bAutoWidth": true,
            "order": [0, "asc"],
        };
      </script>
   
  </head>
  <body>
  <div class="container-scroller">
 