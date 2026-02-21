<?php

$servername = "s6860506004db-kuchalina-hwzz2w";
$username = "Nina6860506004";
$password = "1859900347014";
$dbname = "Nina";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Nina's Tree & Flower System (PHP)</title>
    <style>
        :root { --primary: #ff4081; --bg: #fff5f8; }
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: var(--bg); margin: 0; padding: 20px; display: flex; flex-direction: column; align-items: center; }
        .box { background: white; padding: 25px; border-radius: 20px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); width: 90%; max-width: 900px; margin-bottom: 30px; }
        h1, h2 { color: var(--primary); text-align: center; }
        
       
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: var(--primary); color: white; padding: 12px; }
        td { border-bottom: 1px solid #ffe4f1; padding: 12px; text-align: center; }
        tr:hover { background: #fff0f6; }

     
        #tree-canvas { background: #fdfdfd; border: 2px dashed #ffc1e3; border-radius: 15px; display: block; margin: 20px auto; }
        .input-group { text-align: center; margin-bottom: 20px; }
        input { padding: 10px; border: 2px solid #ffc1e3; border-radius: 8px; width: 80px; text-align: center; }
        button { padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer; background: var(--primary); color: white; font-weight: bold; }
    </style>
</head>
<body>

    <div class="box">
        <h1>🌲 Binary Search Tree Visualizer</h1>
        <div class="input-group">
            <input type="number" id="valInput" placeholder="เลข">
            <button onclick="addNode()">เพิ่มโหนด</button>
            <button onclick="clearTree()" style="background:#888;">ล้างข้อมูล</button>
        </div>
        <canvas id="tree-canvas" width="800" height="400"></canvas>
    </div>

    <div class="box">
        <h2>🌹 รายการกุหลาบใน MariaDB</h2>
        <table>
            <thead>
                <tr>
                    <th>ชื่อสายพันธุ์</th>
                    <th>สี</th>
                    <th>กลิ่น</th>
                    <th>ราคา</th>
                    <th>แหล่งกำเนิด</th>
                    <th>ฤดูกาล</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                $sql = "SELECT * FROM Flower";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                   
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><strong>" . $row["variety_name"] . "</strong></td>";
                        echo "<td>" . $row["color"] . "</td>";
                        echo "<td>" . $row["fragrance"] . "</td>";
                        echo "<td style='color:var(--primary); font-weight:bold;'>" . $row["price"] . " ฿</td>";
                        echo "<td>" . $row["origin"] . "</td>";
                        echo "<td>" . $row["blooming_season"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>ยังไม่มีข้อมูลดอกไม้</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script>
        let root = null;
        const canvas = document.getElementById('tree-canvas');
        const ctx = canvas.getContext('2d');

        class Node { constructor(v) { this.v = v; this.l = null; this.r = null; } }

        function addNode() {
            const v = parseInt(document.getElementById('valInput').value);
            if (!isNaN(v)) { root = insert(root, v); draw(); document.getElementById('valInput').value = ''; }
        }

        function insert(node, v) {
            if (!node) return new Node(v);
            if (v < node.v) node.l = insert(node.l, v);
            else if (v > node.v) node.r = insert(node.r, v);
            return node;
        }

        function draw() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            if (root) render(root, canvas.width / 2, 40, 160);
        }

        function render(n, x, y, space) {
            if (n.l) { line(x, y, x - space, y + 60); render(n.l, x - space, y + 60, space / 2); }
            if (n.r) { line(x, y, x + space, y + 60); render(n.r, x + space, y + 60, space / 2); }
            circle(x, y, n.v);
        }

        function line(x1, y1, x2, y2) { ctx.beginPath(); ctx.moveTo(x1, y1); ctx.lineTo(x2, y2); ctx.stroke(); }
        function circle(x, y, v) {
            ctx.beginPath(); ctx.arc(x, y, 20, 0, 2 * Math.PI); ctx.fillStyle = "#ff4081"; ctx.fill();
            ctx.fillStyle = "white"; ctx.textAlign = "center"; ctx.fillText(v, x, y + 5);
        }
        function clearTree() { root = null; draw(); }
    </script>
</body>
</html>
