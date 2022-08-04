{{-- <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="pills-home-tab" data-toggle="pill"
            href="#pills-home" role="tab" aria-controls="pills-home"
            aria-selected="true">Latest Transactions</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pills-profile-tab" data-toggle="pill"
            href="#pills-profile" role="tab" aria-controls="pills-profile"
            aria-selected="false">All Transactions</a>
    </li>
</ul> --}}



<ul class="nav nav-pills">
    <li class="nav-item">
         <a class="nav-link   active" href="{{ route('bank_report.latest_transactions', $bank->id) }}" >
              Latest Transactions
         </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="" >
             All Transactions
        </a>
   </li>
</ul>
