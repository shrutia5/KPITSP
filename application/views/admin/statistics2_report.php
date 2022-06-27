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
            <p>Total users : <?php echo array_sum($statDataUser);?></p>
            <p>Total projects submitted : <?php echo array_sum($dataProject);?></p>
        </div>
    </div>
</div>