        </div>
    </div>
</div>

</body>
</html>

<!-- Unsetting All Session Veriables except u_id -->
<?php 
    foreach($_SESSION as $key => $val){

        if ($key !== 'u_id')
        {
            unset($_SESSION[$key]);
        }

    }
?>