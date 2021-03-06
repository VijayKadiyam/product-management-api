<!-- Format Number -->
<?php 

  // $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);

  // TO get the first letters
  preg_match_all('/\b\w/', $bill->company->name, $matches); 

?>

<!DOCTYPE html>

<html lang="en">

  <head>

    <title>OSVL/17-18/{{ $bill->invoice_no }}</title>

    <!-- Style-->
    <style type="text/css">
      
      body {
        font-family: "Times New Roman", Georgia, Serif;  
        padding-top: 70px;
      } 

      .header {
        top: 0px;
        position: fixed;
      }

      .footer {
        bottom: 0px;
        position: fixed;
      }

      table {
        width: 100%;
        table-layout: fixed;
      }

      td {
        padding: 2px;
      }

      tr, td {
        border: 1px solid black;
      }

      table {
        border: 1px solid black;
        border-collapse: collapse;
      }

      tr.noBottomBorder td {
        border-bottom-color: transparent;
      }

      tr.noTopBorder td {
        border-top-color: transparent;
      } 

      .wrapper {
        width: 100%;
        padding-bottom: 3px;
      }

      .div-inline {
        display: inline-block; 
        vertical-align: top;
        width: 49.5%; 
      }

      .align-top {
        vertical-align: top;
      }

      .align-bottom {
        vertical-align: bottom;
      }

    </style>

  </head>

  <body> 

    <!-- Header -->
    <!-- <div class="header">
      <img src="" width="100%">
    </div> -->  

    <!-- Bill Heading -->
    <h3 align="center">DELIVERY CHALLAN</h3>

    <!-- <h3 align="right">Mobile No. : { Insert this filed in companies table }</h3> -->

    <div class="wrapper">
      <table> 
        <!-- Company Name and Address-->
        <tr align="center">
          <td>
            <b>{{ $bill->company->name }}</b>
            <br>
            {{ $bill->company->address }}
            <br>
            <b>GSTIN/UIN: </b>{{ $bill->company->gstn_no }}
            <br>
            <b>State Code: </b> {{ $bill->company->state_code }}
            <br>
            <b>Email ID:</b> {{ $bill->company->email }}
            <br>
            <b>Mob No. </b> {{ $bill->company->contact1 }}
          </td> 
        </tr>   
      </table>
    </div>

    <!-- Basic Details -->
    <div class="wrapper"> 

        <table> 

          <!-- Customer Name and Address-->
          <tr>
            <td rowspan="4" colspan="2">
              <b>{{ $bill->customer->name }}</b>
              <br>
              {{ $bill->customer->address }}
              <br>
              {{ $bill->customer->email }}
              <br>
              <b>Mob No. </b>{{ $bill->customer->contact1 }}
            </td>
            <td>
              <b>Challan No.</b>
            </td>
            <td>
              {{ $settings->bill_format }}{{ $bill->bill_no }}
            </td>
          </tr> 

          <!-- Date No -->
          <tr>
            <td>
              <b>Date :</b>
            </td>
            <td>
              {{ $bill->created_at }}
            </td>
          </tr> 

          <!-- Vehicle No. -->
          <tr>
            <td>
              <b>Vehicle No. :</b>
            </td>
            <td>
              {{ $bill->despatch_through }}
            </td>
          </tr> 

          <!-- Destination -->
          <tr>
            <td>
              <b>Destination :</b>
            </td>
            <td>
              {{ $bill->destination }}
            </td>
          </tr> 

        </table> 
        
      </div> 

    </div> 

    <!-- Charges Details -->
    <h4><u>Description as follows:</u></h4>
    <div class="wrapper">

      <table>
        <!-- Heading   -->
        <tr align="center">
          <td>
            <b>Sr. No.</b>
          </td>
          <td colspan="3">
            <b>Description of Goods</b>
          </td>
          <td>
            <b>Bags</b>
          </td> 
          <td>
            <b>Weight</b>
          </td>
          <td>
            <b>Remarks</b>
          </td>
        </tr>

        <!-- Billing details -->
        @foreach($bill->billing_details as $billing_detail)
        <tr align="center" class="noBottomBorder" style="height: 200px;"> 

            <!-- Sr. No -->
            <td style="height:40px;">
              {{ $loop->index + 1 }}
            </td>

            <!-- Description -->
            <td colspan="3">
              {{ $billing_detail->product_category->name }}
            </td>

            <!-- Quantity -->
            <td>
              {{ $billing_detail->qty }}
            </td>

            <!-- Weight -->
            <td>
              <?php $quantity = 0; ?>
              @foreach($billing_detail->product_category->stock_categories as $stock_category)
                <?php $quantity += $stock_category->pivot->value; ?>
              @endforeach
              {{ $quantity * $billing_detail->qty }} Kgs
            </td>

            <!-- Remarks -->
            <td></td>

        </tr>
        @endforeach  

      </table>
      
    </div>  

    <!-- Terms -->
    <div class="wrapper">

      <table>

        <tr>
          
          <td>

            <b>Receiver's Signature </b> 
            <br> 

          </td>

          <td style="vertical-align: top" align="center">
            <small>
              Certified that the particular given above are true and correct
            </small>
            <br>
            <b>For {{ strtoupper($bill->company->name) }}</b>
            <br>
            <br> 
            <br> 
            <label>
              <b>Authorized Signatory</b>
            </label>
          </td>

        </tr>  

      </table>
      
    </div> 
  
  </body>

</html>