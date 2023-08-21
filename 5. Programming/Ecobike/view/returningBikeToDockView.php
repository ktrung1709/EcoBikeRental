<!DOCTYPE html>
<html>
<head>
    <style>
        /* CSS styles here */
        .navbar {
            /*background-color: transparent;*/
            width: 100%;
            height: 60px;
            /*box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);*/
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .select-dock-text {
            color: #8c36c0;
            font-weight: bold;
            font-size: 48px;
        }

        .search-dock-container {
            border: 2px solid yellow;
            display: flex;
            justify-content: space-between;
            padding: 10px;
            height: 70%;
        }

        .search-pane {
            background-color: #F0F0F0;
            border-radius: 2px;
            border-color: #5F5F5F;
            width: 450px;
            height: 45px;
            margin-left: 10px;
            margin-top: 10px;
        }

        .search-bar {
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search-field {
            background-color: transparent;
            font-size: 18px;
            margin-left: 30px;
            border-color: transparent;
        }

        .search-img {
            width: 24px;
            height: 24px;
            cursor: pointer;
        }

        .dock-list {
            display: flex;
            flex-wrap: wrap;
            /*margin: 10px;*/
            width: 100%;
        }

        .dock-item {
            width: calc(40% - 20px); /* Chia thành 3 phần ngang */
            height: 110px;
            margin: 10px;
            border: 1px solid #8c36c0;
            padding: 25px;
            cursor: pointer;
        }

        .dock-image-detail {
            width: 150x;
            height: 150px;
        }

        .dock-image {
            float: left;
            margin-right: 10px;
            width: 100px;
            height: 100px;
        }

        .dock-info {
            float: left;
        }

        .dock-name {
            color: black;
            margin-bottom: 60px;
            font-weight: bold;
            font-size: 20px;
        }

        .dock-name-detail {
            color: black;
            font-weight: bold;
        }

        .dock-slots {
            color: #8c36c0;
            font-weight: bold;
        }

        .dock-details {
            /*background-color: yellow;*/
            color: white;
            text-align: center;
            padding: 20px;
            display: none;
        }

        .return-bike-btn {
            background-color: #8c36c0;
            color: #F0F0F0;
            font-weight: bold;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            align-items: center;
            justify-content: center;
        }
    </style>
    <script>
        // JavaScript code here
        function showDockDetails(name, slots, img_src) {
            document.querySelector('.dock-details .dock-name-detail').textContent = name;
            document.querySelector('.dock-details .dock-slots').textContent = slots;

            var dockImage = document.querySelector('.dock-details .dock-image-detail');
            dockImage.src = img_src;

            document.querySelector('.dock-details').style.display = 'block';
        }
    </script>
</head>
<body>
    <div class="navbar">
        <span class="select-dock-text">SELECT DOCK FOR RETURNING</span>
    </div>

    <div class="search-dock-container">
        <div class="search-pane">
            <div class="search-bar">
                <img src="view/icons/search_icon.png" alt="Search" class="search-img">
                <input type="text" class="search-field" placeholder="Search">
            </div>

            <div class="dock-details">
                <img class="dock-image-detail">
                <!-- <div class="dock-info"> -->
                <div class="dock-name-detail">Dock Name</div>
                <div class="dock-slots">SLOT ab/cd</div>
                <!-- </div> -->
            <button class="return-bike-btn">RETURN BIKE HERE</button>
            </div>

        </div>

        
        <div class="dock-list">
    <?php
    foreach ($dockList as $dock) {
        echo '
        <div class="dock-item" onclick="showDockDetails(\'' . $dock->getLocation() . '\', \'SLOT ' . $dock->getNumberOfAvailableBike() . '/' . $dock->getCapacity() . '\', \'' . $dock->getImageURL() . '\')">
            <img class="dock-image" src="' . $dock->getImageURL() . '">
            <div class="dock-info">
                <div class="dock-name">' . $dock->getName() . '</div>
                <div class="dock-slots">SLOT ' . $dock->getNumberOfAvailableBike() . '/' . $dock->getCapacity() . '</div>
            </div>
        </div>
        ';
    }
    ?>
</div>

            <!-- <div class="dock-item" onclick="showDockDetails('Dong Da', 'SLOT 10/200')">
                <img class="dock-image" src="data:image/png;base64, ...">
                <div class="dock-info">
                    <div class="dock-name">Dong Da</div>
                    <div class="dock-slots">SLOT 10/200</div>
                </div>
            </div>
            <div class="dock-item" onclick="showDockDetails('Ha Dong', 'SLOT 50/100')">
                <img class="dock-image" src="data:image/png;base64, ...">
                <div class="dock-info">
                    <div class="dock-name">Ha Dong</div>
                    <div class="dock-slots">SLOT 50/100</div>
                </div>
            </div> -->
        </div>
    </div>

</body>
</html>

