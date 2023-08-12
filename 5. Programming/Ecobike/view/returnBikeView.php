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
            width: 405px;
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
            width: calc(33.33% - 20px); /* Chia thành 3 phần ngang */
            margin: 10px;
            border: 1px solid #8c36c0;
            padding: 10px;
            cursor: pointer;
        }

        .dock-image-detail {
            width: 200x;
            height: 200px;
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
        function showDockDetails(name, slots) {
            document.querySelector('.dock-details .dock-name').textContent = name;
            document.querySelector('.dock-details .dock-slots').textContent = slots;
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
                <img src="view/image/icons/search_icon.png" alt="Search" class="search-img">
                <input type="text" class="search-field" placeholder="Search">
            </div>

            <div class="dock-details">
                <img class="dock-image-detail" src="...">
                <!-- <div class="dock-info"> -->
                <div class="dock-name">Dock Name</div>
                <div class="dock-slots">SLOT 196/200</div>
                <!-- </div> -->
            <button class="return-bike-btn">RETURN BIKE HERE</button>
            </div>

        </div>

        <div class="dock-list">
            <div class="dock-item" onclick="showDockDetails('Hai Ba Trung', 'SLOT 100/200')">
                <img class="dock-image" src="data:image/png;base64, ...">
                <div class="dock-info">
                    <div class="dock-name">Hai Ba Trung</div>
                    <div class="dock-slots">SLOT 100/200</div>
                </div>
            </div>
            <div class="dock-item" onclick="showDockDetails('Dong Da', 'SLOT 10/200')">
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
            </div>
        </div>
    </div>

</body>
</html>
