<div>
    <h1>TotCloud Configuration Console</h1>
    <section class="configurableItemSection">
        <h2> Compute Configuration</h2>
        <details>
            <summary class="configurableItemTitle">CPU</summary>
            <div class="configurableItemContent">
                <form action="submit_item.php" method="POST">
                    <h3>CPU Details</h3>

                    <label for="cpu">Select Model:</label>
                    <select id="cpu" name="cpu" required onchange="handleDropdownChange()">
                        <option value="--New--">--New--</option>
                        <?php
                        $CPUs = $dataBase->selectCPUs(); // Ensure this returns an array
                        foreach ($CPUs as $CPU) {
                            echo '<option value="' . htmlspecialchars($CPU, ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($CPU, ENT_QUOTES, 'UTF-8') . '</option>';
                        }
                        ?>
                    </select>

                    <br><br>

                    <label for="model">Model:</label>
                    <input type="text" id="model" name="model" required>

                    <br>
                    
                    <label for="serie">Series:</label>
                    <select id="serie" name="serie" required>
                        <option selected disabled="disabled" value="">Select an option</option>
                        <?php
                        $series = $dataBase->selectSeries(); // Ensure this returns an array
                        foreach ($series as $serie) {
                            echo '<option value="' . htmlspecialchars($serie, ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($serie, ENT_QUOTES, 'UTF-8') . '</option>';
                        }
                        ?>
                    </select>

                    <label for="coreCount">Core Count:</label>
                    <input min="1" max="256" type="number" id="coreCount" name="coreCount" required>

                    <br>
                    
                    <label for="frequency">Frequency (GHz):</label>
                    <input min="0.5" max="6" step="0.01" type="number" id="frequency" name="frequency" required>

                    <br><br>
                    
                    <label for="cachel1">Cache L1 (MB):</label>
                    <input min="1" max="256" type="number" id="cachel1" name="cachel1" required>

                    <label for="cachel2">Cache L2 (MB):</label>
                    <input placeholder="0" min="1" max="256" type="number" id="cachel2" name="cachel2">

                    <label for="cachel3">Cache L3 (MB):</label>
                    <input placeholder="0" min="1" max="256" type="number" id="cachel3" name="cachel3">

                    <br><br>
                    
                    <label for="cost">Sales Price:</label>
                    <input min="0" step="0.01" type="number" id="cost" name="cost" required>

                    <h3>CPU Compatibility</h3>

                    <button type="submit">Submit</button>
                </form>
            </div>
        </details>

        <details>
            <summary class="configurableItemTitle">Memory</summary>
            <div class="configurableItemContent">
                Epcot is a theme park at Walt Disney World Resort featuring exciting attractions, international
                pavilions, award-winning fireworks and seasonal special events.
            </div>
        </details>

        <details>
            <summary class="configurableItemTitle">Operating System</summary>
            <div class="configurableItemContent">
                Epcot is a theme park at Walt Disney World Resort featuring exciting attractions, international
                pavilions, award-winning fireworks and seasonal special events.
            </div>
        </details>
    </section>

    <section class="configurableItemSection">
        <h2> Storage Configuration</h2>
        <details>
            <summary class="configurableItemTitle">CPU</summary>
            <div class="configurableItemContent">
                Epcot is a theme park at Walt Disney World Resort featuring exciting attractions, international
                pavilions, award-winning fireworks and seasonal special events.
            </div>
        </details>
    </section>

    <section class="configurableItemSection">
        <h2> Compute Configuration</h2>
        <details>
            <summary class="configurableItemTitle">CPU</summary>
            <div class="configurableItemContent">
                Epcot is a theme park at Walt Disney World Resort featuring exciting attractions, international
                pavilions, award-winning fireworks and seasonal special events.
            </div>
        </details>
    </section>
</div>