<div class="">
    <script>
        var datastat = <?php echo "[".implode(",",$statDataUser)."]";?>;
        var dataProject = <?php echo "[".implode(",",$dataProject)."]";?>;
        var dataLabel = <?php echo "['".implode("','",$dataLabel)."']";?>;
        
    </script>
    <div class="row">
        <div class="col-md-6">
            <canvas id="statData" width="300" height="300"></canvas>
        </div>
        <div class="col-md-6">
            <br/>
            <br/>
            <br/>
            <p>Total users : <?php echo $regCount;?> & Total ideas : <?php echo $ideaCount;?></p>
            <p>Previous Registered users : 5356</p>
            <br/>
            <p>New Registered users : <?php echo $newregCount;?></p>
            <p>Number of States : <?php echo $stateCount;?></p>
            <p>Number of Colleges : <?php echo $collegeCount;?></p>
            <p>Number of Premier Institutes : <?php echo $premCount;?></p>
            <p>Reg.: <?php echo $premregCount;?> Ideas: <?php echo $premideaCount;?></p>
            <br/>
            <p>Number of Top 100 colleges : <?php echo $topCount;?></p>
            <p>Reg.: <?php echo $topregCount;?> Ideas: <?php echo $topideaCount;?></p>
        </div>
    </div>
</div>