<?php
use App\Lib\Permissions;
?>
<style>
    .not{
        background-color:#ccffcc;
    }
    .not.hover{
        background-color: #aaffaa;
    }
</style>
<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
        <!-- Apoio Cliente -->

        <li title="Orders" class="messages-menu">
            <a href="/">
                <i class="fa fa-credit-card"></i>
                <span class="label label-danger">0</span>
            </a>
        </li>
        <li title="Messages" class="messages-menu">
            <a href="/">
                <i class="fa fa-envelope"></i>
                <span class="label label-danger">2</span>
            </a>
        </li>
    </ul>

</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>