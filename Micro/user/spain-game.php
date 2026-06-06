<?php
    session_start();
    ob_start();
	include_once('header.php');
	include_once('../db/index.php');
	
	if (!isset($_SESSION['user_id'])) {
		header("Location: ../login.php");
		exit();
	}
	$userId = $_SESSION['user_id'];
	$blanceQuery = $pdo->prepare("SELECT total_earning, main_blance, total_coin, rit_coin, free_spain FROM blance WHERE user_id = ?");
	$blanceQuery->execute([$userId]);
	$blance = $blanceQuery->fetch(PDO::FETCH_ASSOC);
	
	$userQuery = $pdo->prepare("SELECT active_status FROM users WHERE id = ?");
	$userQuery->execute([$userId]);
	$user = $userQuery->fetch();
	
	if (isset($_POST['coin_spain'])) {
		$total_coin = $blance['total_coin'];
		
		$checkSpin = $pdo->prepare("SELECT COUNT(*) FROM spin_history WHERE user_id = ? AND spin_type = 'coin' AND DATE(spin_date) = CURDATE()");
		$checkSpin->execute([$userId]);
		$alreadySpunToday = $checkSpin->fetchColumn();

		// প্রাইজ লিস্ট
		$prizes = [
			["text" => "2X", "value" => 2,      "probability" => 12],
			["text" => "1.5X", "value" => 1.5,  "probability" => 15],
			["text" => "0.5X", "value" => 0.5,  "probability" => 10],
			["text" => "JACKPOT", "value" => 10,"probability" => 3],
			["text" => "1X", "value" => 1,      "probability" => 15],
			["text" => "0X", "value" => 0,      "probability" => 15],
			["text" => "1.2X", "value" => 1.2,  "probability" => 15],
			["text" => "0.8X", "value" => 0.8,  "probability" => 15]
		];

		if ($total_coin < 10) {
			$_SESSION['spin_error'] = "Insufficient coins!";
		} else if ($user['active_status'] != 1) {
			$_SESSION['spin_error'] = "Only active users can spin!";
		} else if($alreadySpunToday > 0){
			$_SESSION['spin_error'] = "You have already used your spin for today!";
		}else {
			// র‍্যান্ডম প্রাইজ বের করো
			$winIndex = array_rand($prizes);
			$prize = $prizes[$winIndex];
			$bet = 10;
			$winnings = $bet * $prize['value'];

			try {
				$pdo->beginTransaction();

				// কাটো 10 coin
				$pdo->prepare("UPDATE blance SET total_coin = total_coin - 10 WHERE user_id = ?")->execute([$userId]);

				// জয় পেলে যোগ করো
				if ($winnings > 0) {
					$pdo->prepare("UPDATE blance SET total_coin = total_coin + ? WHERE user_id = ?")->execute([$winnings, $userId]);
				}

				// হিস্টোরি সংরক্ষণ
				$pdo->prepare("INSERT INTO spin_history (user_id, spin_type, bet_amount, prize_text, prize_value, winnings, spin_date) VALUES (?, 'coin', ?, ?, ?, ?, NOW())")->execute([
					$userId, $bet, $prize['text'], $prize['value'], $winnings
				]);

				$pdo->commit();

				// প্রাইজ দেখানোর জন্য সেশন সেট করো
				$_SESSION['spin_result'] = [
					'prize' => $prize['text'],
					'value' => $prize['value'],
					'winnings' => $winnings
				];

				header("Location: spain-game.php");
				exit;

			} catch (Exception $e) {
				$pdo->rollBack();
				$_SESSION['spin_error'] = "Something went wrong!";
			}
		}
	}
	
	if (isset($_POST['free_spain'])) {
		$freeSpain = $blance['free_spain'];

		// প্রাইজ লিস্ট
		$prizes = [
			["text" => "2X", "value" => 2,      "probability" => 12],
			["text" => "1.5X", "value" => 1.5,  "probability" => 15],
			["text" => "0.5X", "value" => 0.5,  "probability" => 10],
			["text" => "JACKPOT", "value" => 10,"probability" => 3],
			["text" => "1X", "value" => 1,      "probability" => 15],
			["text" => "0X", "value" => 0,      "probability" => 15],
			["text" => "1.2X", "value" => 1.2,  "probability" => 15],
			["text" => "0.8X", "value" => 0.8,  "probability" => 15]
		];

		if ($freeSpain <= 0) {
			$_SESSION['spin_error'] = "Not Available Free Spain!";
			
		} else if ($user['active_status'] != 1) {
			$_SESSION['spin_error'] = "Only active users can spin!";
		} else {
			// র‍্যান্ডম প্রাইজ বের করো
			$winIndex = array_rand($prizes);
			$prize = $prizes[$winIndex];
			$bet = 1;
			$winnings = $bet * $prize['value'];

			try {
				$pdo->beginTransaction();

				// কাটো 10 coin
				$pdo->prepare("UPDATE blance SET free_spain = free_spain - 1 WHERE user_id = ?")->execute([$userId]);

				// জয় পেলে যোগ করো
				if ($winnings > 0) {
					$pdo->prepare("UPDATE blance SET total_coin = total_coin + ? WHERE user_id = ?")->execute([$winnings, $userId]);
				}

				// হিস্টোরি সংরক্ষণ
				$pdo->prepare("INSERT INTO spin_history (user_id, spin_type, bet_amount, prize_text, prize_value, winnings, spin_date) VALUES (?, 'free', ?, ?, ?, ?, NOW())")->execute([
					$userId, $bet, $prize['text'], $prize['value'], $winnings
				]);

				$pdo->commit();

				// প্রাইজ দেখানোর জন্য সেশন সেট করো
				$_SESSION['spin_result'] = [
					'prize' => $prize['text'],
					'value' => $prize['value'],
					'winnings' => $winnings,
					'type' => 'free'
				];

				header("Location: spain-game.php");
				exit;

			} catch (Exception $e) {
				$pdo->rollBack();
				$_SESSION['spin_error'] = "Something went wrong!";
			}
		}
		
	}
	
	$select = "SELECT * FROM spin_history WHERE user_id = ? AND spin_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH) 
	ORDER BY spin_date DESC LIMIT 10";
	$historyQuery = $pdo->prepare($select);	
	$historyQuery->execute([$userId]);
	
?> 
<?php if (isset($_SESSION['spin_error'])): ?>
	<script>
		alert("<?php echo $_SESSION['spin_error']; ?>");
	</script>
	<?php unset($_SESSION['spin_error']); ?>
<?php endif; ?>

    <!-- Main Game Container -->
    <div class="game-container">
        <div class="game-header">
            <h1><i class="fas fa-trophy me-2"></i> Lucky Spin Game</h1>
            <p>Spin the wheel and win amazing prizes!</p>
        </div>
        
        <!-- Jackpot Banner -->
        <div class="jackpot-banner">
            <div><i class="fas fa-crown me-2"></i> CURRENT JACKPOT</div>
            <div class="jackpot-amount">BDT 100 TK</div>
            <div>Next spin could be yours!</div>
        </div>
        
        <!-- Game Stats -->
        <div class="game-stats">
            <div class="stats-grid">
				<div class="stat-card">
                    <div class="stat-label">Main Blance</div>
                    <div class="stat-value"><?php echo $blance['main_blance']; ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Coin</div>
                    <div class="stat-value"><?php echo $blance['total_coin']; ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Rit Coin</div>
                    <div class="stat-value"><?php echo $blance['rit_coin']; ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Free Spain</div>
					<span class="free-spins-badge">
						<i class="fas fa-gift"></i> <?php echo $blance['free_spain']; ?> Free
					</span>
                </div>
            </div>
            
            <!-- Bet Controls -->
            <div class="bet-controls" style="display: none;">
                <button class="bet-btn" id="decreaseBet"><i class="fas fa-minus"></i></button>
                <div class="bet-amount" id="currentBet">10</div>
                <button class="bet-btn" id="increaseBet"><i class="fas fa-plus"></i></button>
            </div>
        </div>
        
        <!-- Spin Wheel -->
        <div class="spin-wheel-container">
            <div class="wheel-wrapper">
                <div class="wheel" id="wheel">
                    <!-- Wheel sections will be added by JavaScript -->
                </div>
                <div class="wheel-center"></div>
                <div class="wheel-pointer"></div>
            </div>
            
            <div class="d-flex gap-3">
				<form method="POST">
					<input type="hidden" name="coin_spain" value="1">
					<button type="submit" class="spin-btn" name="coin_spain" id="spinButton">
						<i class="fas fa-sync-alt me-2"></i> SPIN (10 coin)
					</button>
				</form>
				<form method="POST" id="freeSpinForm">
					<input type="hidden" name="free_spain" value="1">
					<button type="submit" class="spin-btn free-spin-btn" name="free_spain" id="freeSpinButton">
						<i class="fas fa-gift me-2"></i> FREE SPIN
					</button>
				</form>
            </div>
					
        </div>
        
        <!-- Spin History -->
        <div class="history-card">
            <div class="history-title">
                <i class="fas fa-history me-2"></i> Your Spin History
            </div>
            <div class="table-responsive">
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Spin Type</th>
                            <th>Bet Amount</th>
                            <th>Result</th>
                            <th>Prize</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php 
							while($history = $historyQuery->fetch()){
								?>
									<tr>
										<td><?php echo $history['spin_date']; ?></td>
										<td><?php echo $history['spin_type']; ?></td>
										<td><?php echo $history['bet_amount']; ?></td>
										<td><span class="prize-won"><?php echo $history['prize_text']; ?></span></td>
										<td><span class="prize-won"><?php echo $history['winnings']; ?></span></td>
									</tr>
								<?php								
							}							
						?>
                    </tbody>
                </table>
            </div>
        </div>        
    </div>
   
    <!-- Prize Modal -->
     <!-- Enhanced Prize Modal -->
    <div class="modal fade" id="prizeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content spain-modal-content">
				<form method="POST">
					<div class="modal-header">
						<h5 class="modal-title" id="prizeModalTitle">Congratulations!</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body text-center">
						<img src="https://via.placeholder.com/100/f59e0b/ffffff?text=🎁" class="prize-modal-img" id="prizeImage">
						
						<h4>You won: <span id="prizeAmount" class="text-success">2X Multiplier</span></h4>
						<h3 class="my-3" id="prizeValue">$20.00</h3>
						<p class="mt-3" id="prizeMessage">Your winnings have been added to your balance!</p>
					</div>
					<div class="modal-footer justify-content-center">
						<button type="button" class="btn btn-primary" name="prize_recive" data-bs-dismiss="modal">Continue</button>
					</div>
				</form>
				<?php 
					if(isset($_POST['prize_recive'])){
						// update spain prize
					}				
				?>
            </div>
        </div>
    </div>
	
	
	
	
	<?php if (isset($_SESSION['spin_result'])): ?>
	<script>
	document.addEventListener('DOMContentLoaded', function () {
		const prize = <?php echo json_encode($_SESSION['spin_result']); ?>;
		
		// Modal এ prize দেখাও
		document.getElementById('prizeAmount').textContent = prize.prize;
		document.getElementById('prizeValue').textContent = '+' + prize.winnings + ' Coins';
		document.getElementById('prizeImage').src = `https://via.placeholder.com/100/10b981/ffffff?text=🎁`;
		document.getElementById('prizeModalTitle').textContent = (prize.value == 0) ? "Better Luck Next Time!" : "Congratulations!";
		document.getElementById('prizeMessage').textContent = (prize.type === 'free') 
			? "You won this with a free spin!"
			: "Your winnings have been added to your balance!";
			
		// Modal দেখাও
		new bootstrap.Modal(document.getElementById('prizeModal')).show();
	});
	</script>
	<?php unset($_SESSION['spin_result']); endif; ?>
    <?php include_once('footer.php'); ?>
	
</body>
</html>