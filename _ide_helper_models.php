<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $deleted_at
 * @property string $username
 * @property string $nickname
 * @property string $password
 * @property string $school
 * @property string $email
 * @property \Illuminate\Support\Carbon $email_verified_at
 * @property int $status -1: lock, 0: normal, 1: need verify by admin
 * @property string $remember_token
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $group
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Mail[] $mailReceived
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Mail[] $mailSent
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Solution[] $solutions
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSchool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUsername($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ContestResult
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property int $contest_problem_id
 * @property int $user_id
 * @property int $contest_id
 * @property int $submit_count value mean submit times
 * @property string $ac_at
 * @property-read \App\Models\Contest $contest
 * @property-read \App\Models\ContestProblem $problem
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestResult newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestResult newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestResult query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestResult whereAcAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestResult whereContestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestResult whereContestProblemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestResult whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestResult whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestResult whereSubmitCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestResult whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestResult whereUserId($value)
 */
	class ContestResult extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $deleted_at
 * @property string $username
 * @property string $nickname
 * @property string $password
 * @property string $school
 * @property string $email
 * @property \Illuminate\Support\Carbon $email_verified_at
 * @property int $status -1: lock, 0: normal, 1: need verify by admin
 * @property string $remember_token
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $group
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Mail[] $mailReceived
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Mail[] $mailSent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Solution[] $solutions
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereSchool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUsername($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Group
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $deleted_at
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereUpdatedAt($value)
 */
	class Group extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Solution
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property int $owner_id
 * @property int $contest_id
 * @property int $problem_id
 * @property int $contest_problem_id
 * @property string $hash
 * @property int $lang
 * @property int $result -3:RJ WAIT, -2:WAIT, -1:RUN, 0:AC, 1:WA, 2:PE, 3:TLE, 4:MLE, 5:OLE, 6:RE, 7:SE
 * @property int $time_used ms
 * @property int $memory_used kb
 * @property int $similar_at
 * @property int $similar_percent
 * @property-read \App\Models\SolutionCode $code
 * @property-read \App\Models\SolutionFullResult $fullResult
 * @property-read \App\Models\User $owner
 * @property-read \App\Models\Problem $problem
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Solution newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Solution newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Solution query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Solution whereContestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Solution whereContestProblemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Solution whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Solution whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Solution whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Solution whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Solution whereMemoryUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Solution whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Solution whereProblemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Solution whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Solution whereSimilarAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Solution whereSimilarPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Solution whereTimeUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Solution whereUpdatedAt($value)
 */
	class Solution extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DiscussPostContext
 *
 * @property int $discuss_post_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string $context
 * @property-read \App\Models\DiscussPost $post
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussPostContext newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussPostContext newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussPostContext query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussPostContext whereContext($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussPostContext whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussPostContext whereDiscussPostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussPostContext whereUpdatedAt($value)
 */
	class DiscussPostContext extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Contest
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string $deleted_at
 * @property int $owner_id
 * @property string $start_at
 * @property string $end_before
 * @property int $privilege 0: public 1: private 2: protect 3: need register
 * @property string $privilege_info
 * @property int $allow_language 0 is all allow, if a bit set 1, that mean the kind of lang not allow
 * @property int $lock_rank_at 0 for no, 20 for at last 20% time
 * @property-read \App\Models\ContestIpLimit $ipLimits
 * @property-read \App\Models\User $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ContestPrivilege[] $privileges
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ContestProblem[] $problemList
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ContestRegister[] $register
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ContestResult[] $result
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contest query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contest whereAllowLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contest whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contest whereEndBefore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contest whereLockRankAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contest whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contest wherePrivilege($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contest wherePrivilegeInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contest whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contest whereUpdatedAt($value)
 */
	class Contest extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Mail
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $deleted_at
 * @property int $from_user_id
 * @property int $to_user_id
 * @property string $topic
 * @property int $status 0: new mail, 1: has read
 * @property-read \App\Models\MailContext $context
 * @property-read \App\Models\User $fromUser
 * @property-read \App\Models\User $toUser
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mail query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mail whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mail whereFromUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mail whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mail whereToUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mail whereTopic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mail whereUpdatedAt($value)
 */
	class Mail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProblemExtraCode
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property int $blank_count
 * @property string $extra_code
 * @property-read \App\Models\Problem $problem
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProblemExtraCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProblemExtraCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProblemExtraCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProblemExtraCode whereBlankCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProblemExtraCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProblemExtraCode whereExtraCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProblemExtraCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProblemExtraCode whereUpdatedAt($value)
 */
	class ProblemExtraCode extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProblemDescription
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string $description
 * @property string $input
 * @property string $output
 * @property string $sample include sample input and sample output
 * @property string $hint
 * @property-read \App\Models\Problem $problem
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProblemDescription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProblemDescription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProblemDescription query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProblemDescription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProblemDescription whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProblemDescription whereHint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProblemDescription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProblemDescription whereInput($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProblemDescription whereOutput($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProblemDescription whereSample($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProblemDescription whereUpdatedAt($value)
 */
	class ProblemDescription extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DiscussPost
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $deleted_at
 * @property int $owner_id
 * @property int $topic_id
 * @property int $status r->l count, 0 = false. 0bit: is locked 1bit: is topping 2bit: is not show
 * @property-read \App\Models\DiscussPostContext $context
 * @property-read \App\Models\DiscussTopic $topic
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussPost query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussPost whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussPost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussPost whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussPost whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussPost whereTopicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussPost whereUpdatedAt($value)
 */
	class DiscussPost extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\News
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $deleted_at
 * @property int $owner_id
 * @property string $title
 * @property int $status -1: hide\0: normal\n1:top
 * @property-read \App\Models\NewsContext $context
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereUpdatedAt($value)
 */
	class News extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Option
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string $key
 * @property string $value data in json
 * @property string $comment
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Option newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Option newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Option query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Option whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Option whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Option whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Option whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Option whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Option whereValue($value)
 */
	class Option extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SolutionFullResult
 *
 * @property int $solution_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string $data
 * @property-read \App\Models\Solution $solution
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SolutionFullResult newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SolutionFullResult newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SolutionFullResult query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SolutionFullResult whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SolutionFullResult whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SolutionFullResult whereSolutionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SolutionFullResult whereUpdatedAt($value)
 */
	class SolutionFullResult extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MailContext
 *
 * @property int $mail_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string $context
 * @property-read \App\Models\Mail $mail
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailContext newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailContext newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailContext query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailContext whereContext($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailContext whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailContext whereMailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailContext whereUpdatedAt($value)
 */
	class MailContext extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DiscussTopic
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $deleted_at
 * @property int $owner_id
 * @property int $contest_id
 * @property int $problem_id
 * @property string $title
 * @property int $status r->l count, 0 = false. 0bit: is locked, 1bit: is topping
 * @property int $views
 * @property int $replies
 * @property string $latest_reply_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DiscussPost[] $posts
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussTopic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussTopic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussTopic query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussTopic whereContestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussTopic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussTopic whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussTopic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussTopic whereLatestReplyAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussTopic whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussTopic whereProblemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussTopic whereReplies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussTopic whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussTopic whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussTopic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiscussTopic whereViews($value)
 */
	class DiscussTopic extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ContestRegister
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $deleted_at
 * @property int $contest_id
 * @property int $user_id
 * @property string $actual_name
 * @property string $college
 * @property string $discipline it means: a branch of knowledge, typically one studied in higher education.
 * @property int $sex 0: secret, 1: male, 2: female
 * @property int $status -1: pending 0: accept 1: wait for update info 2: reject
 * @property-read \App\Models\Contest $contest
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestRegister newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestRegister newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestRegister query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestRegister whereActualName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestRegister whereCollege($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestRegister whereContestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestRegister whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestRegister whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestRegister whereDiscipline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestRegister whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestRegister whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestRegister whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestRegister whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestRegister whereUserId($value)
 */
	class ContestRegister extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\NewsContext
 *
 * @property int $news_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string $context
 * @property-read \App\Models\News $news
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewsContext newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewsContext newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewsContext query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewsContext whereContext($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewsContext whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewsContext whereNewsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewsContext whereUpdatedAt($value)
 */
	class NewsContext extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Problem
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $deleted_at
 * @property int $owner_id
 * @property string $title
 * @property string $source
 * @property int $time_limit Time limit in ms
 * @property int $memory_limit memory limit in kb
 * @property int $is_special_judge 0 = false, 1 = true
 * @property int $type 0: normal 1: supplement after submit code. 2: supplement before judge
 * @property int $similar_from
 * @property int $status 0: normal, 1: hide
 * @property string $testdate_updated_at
 * @property-read \App\Models\ProblemDescription $description
 * @property-read \App\Models\ProblemExtraCode $extraCode
 * @property-read \App\Models\User $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Solution[] $solution
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Problem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Problem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Problem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Problem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Problem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Problem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Problem whereIsSpecialJudge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Problem whereMemoryLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Problem whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Problem whereSimilarFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Problem whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Problem whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Problem whereTestdateUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Problem whereTimeLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Problem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Problem whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Problem whereUpdatedAt($value)
 */
	class Problem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ContestProblem
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property int $contest_id
 * @property int $problem_id
 * @property string $title
 * @property int $problem_order the serial number of problem
 * @property-read \App\Models\Contest $contest
 * @property-read \App\Models\Problem $problem
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ContestResult[] $result
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestProblem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestProblem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestProblem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestProblem whereContestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestProblem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestProblem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestProblem whereProblemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestProblem whereProblemOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestProblem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestProblem whereUpdatedAt($value)
 */
	class ContestProblem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ContestIpLimit
 *
 * @property int $contest_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string $deny_ips JSON CIDR
 * @property string $allow_ips JSON CIDR
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestIpLimit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestIpLimit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestIpLimit query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestIpLimit whereAllowIps($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestIpLimit whereContestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestIpLimit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestIpLimit whereDenyIps($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestIpLimit whereUpdatedAt($value)
 */
	class ContestIpLimit extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LoginLog
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property int $user_id
 * @property string $ip
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginLog whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginLog whereUserId($value)
 */
	class LoginLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ContestPrivilege
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property int $contest_id
 * @property int $user_id
 * @property int $type 0: allow take part in, 1: allow manage
 * @property-read \App\Models\Contest $contest
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestPrivilege newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestPrivilege newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestPrivilege query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestPrivilege whereContestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestPrivilege whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestPrivilege whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestPrivilege whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestPrivilege whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContestPrivilege whereUserId($value)
 */
	class ContestPrivilege extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SolutionCode
 *
 * @property int $solution_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string $code
 * @property-read \App\Models\Solution $solution
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SolutionCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SolutionCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SolutionCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SolutionCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SolutionCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SolutionCode whereSolutionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SolutionCode whereUpdatedAt($value)
 */
	class SolutionCode extends \Eloquent {}
}

