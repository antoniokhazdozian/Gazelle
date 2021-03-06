<?

class Top10View {

	public static function render_linkbox($Selected) { ?>
		<div class="linkbox">
			<a href="top10.php?type=torrents" class="brackets"><?=self::get_selected_link("Torrents", $Selected == "torrents")?></a>
			<? if (check_perms("users_mod")) { ?>
			<a href="top10.php?type=artists" class="brackets"><?=self::get_selected_link("Artists", $Selected == "artists")?></a>
			<? } ?>
			<a href="top10.php?type=users" class="brackets"><?=self::get_selected_link("Users", $Selected == "users")?></a>
			<a href="top10.php?type=tags" class="brackets"><?=self::get_selected_link("Tags", $Selected == "tags")?></a>
			<a href="top10.php?type=votes" class="brackets"><?=self::get_selected_link("Favorites", $Selected == "votes")?></a>
			<a href="top10.php?type=donors" class="brackets"><?=self::get_selected_link("Donors", $Selected == "donors")?></a>
		</div>
<?	}

	public static function render_artist_links($Selected, $View) { ?>
		<div class="center">
			<a href="top10.php?type=artists&amp;category=weekly&amp;view=<?=$View?>" class="brackets"><?=self::get_selected_link("Weekly", $Selected == "weekly")?></a>
			<a href="top10.php?type=artists&amp;category=hyped&amp;view=<?=$View?>" class="brackets"><?=self::get_selected_link("Hyped", $Selected == "hyped")?></a>
			<a href="top10.php?type=artists&amp;category=all_time&amp;view=<?=$View?>" class="brackets"><?=self::get_selected_link("All Time", $Selected == "all_time")?></a>
		</div>
<?	}

	public static function render_artist_controls($Selected, $View) { ?>
		<div class="center">
			<a href="top10.php?type=artists&amp;category=<?=$Selected?>&amp;view=tiles" class="brackets"><?=self::get_selected_link("Tiles", $View == "tiles")?></a>
			<a href="top10.php?type=artists&amp;category=<?=$Selected?>&amp;view=list" class="brackets"><?=self::get_selected_link("List", $View == "list")?></a>
		</div>
<?	}

	private static function get_selected_link($String, $Selected) {
		if ($Selected) {
			return "<strong>" . $String . "</strong>";
		} else {
			return $String;
		}
	}

	public static function render_artist_tile($Artist, $Category) {
		switch ($Category) {
			case 'all_time':
				self::render_tile("artist.php?artistname", $Artist['Name'], $Artist['Image']);
				break;
			case 'weekly':
			case 'hyped':
				self::render_tile("artist.php?artistname=", $Artist['name'], $Artist['image'][3]['#text']);
				break;
			default:
				break;
		}
	}

	private static function render_tile($Url, $Name, $Image) {
		if (!empty($Image)) { ?>
			<li>
				<a href="<?=$Url?><?=$Name?>">
					<img class="tooltip large_tile" title="<?=$Name?>" src="<?=$Image?>" />
				</a>
			</li>
<?		}
	}


	public static function render_artist_list($Artist, $Category) {
		switch ($Category) {
			case 'all_time':
				self::render_list("artist.php?id=", $Artist['id'], $Artist['Image']);
				break;
			case 'weekly':
			case 'hyped':
				self::render_list("artist.php?artistname=", $Artist['name'], $Artist['image'][3]['#text']);
				break;
			default:
				break;
		}
	}

	private static function render_list($Url, $Name, $Image) {
		if (!empty($Image)) {
			$UseTooltipster = !isset(G::$LoggedUser['Tooltipster']) || G::$LoggedUser['Tooltipster'];
			$Title = "title=\"<img class='large_tile' src='$Image'/>\"";
			?>
			<li>
				<a class="tooltip_image" <?=$Title?> href="<?=$Url?><?=$Name?>">
					<?=$Name?>
				</a>
			</li>
<?		}
	}

}
