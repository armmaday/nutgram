<?php


namespace SergiX44\Nutgram\Proxies;

use SergiX44\Nutgram\Telegram\Properties\MessageEntityType;
use SergiX44\Nutgram\Telegram\Types\Boost\ChatBoostRemoved;
use SergiX44\Nutgram\Telegram\Types\Boost\ChatBoostUpdated;
use SergiX44\Nutgram\Telegram\Types\Chat\Chat;
use SergiX44\Nutgram\Telegram\Types\Chat\ChatJoinRequest;
use SergiX44\Nutgram\Telegram\Types\Chat\ChatMemberUpdated;
use SergiX44\Nutgram\Telegram\Types\Common\Update;
use SergiX44\Nutgram\Telegram\Types\Giveaway\Giveaway;
use SergiX44\Nutgram\Telegram\Types\Giveaway\GiveawayCompleted;
use SergiX44\Nutgram\Telegram\Types\Giveaway\GiveawayCreated;
use SergiX44\Nutgram\Telegram\Types\Giveaway\GiveawayWinners;
use SergiX44\Nutgram\Telegram\Types\Inline\CallbackQuery;
use SergiX44\Nutgram\Telegram\Types\Inline\ChosenInlineResult;
use SergiX44\Nutgram\Telegram\Types\Inline\InlineQuery;
use SergiX44\Nutgram\Telegram\Types\Message\Message;
use SergiX44\Nutgram\Telegram\Types\Message\MessageEntity;
use SergiX44\Nutgram\Telegram\Types\Payment\PreCheckoutQuery;
use SergiX44\Nutgram\Telegram\Types\Payment\ShippingQuery;
use SergiX44\Nutgram\Telegram\Types\Poll\Poll;
use SergiX44\Nutgram\Telegram\Types\Poll\PollAnswer;
use SergiX44\Nutgram\Telegram\Types\Reaction\MessageReactionCountUpdated;
use SergiX44\Nutgram\Telegram\Types\Reaction\MessageReactionUpdated;
use SergiX44\Nutgram\Telegram\Types\Shared\UsersShared;
use SergiX44\Nutgram\Telegram\Types\User\User;

/**
 * Trait UpdateProxy
 * @package SergiX44\Nutgram\Proxies
 */
trait UpdateProxy
{
    /**
     * @return Update|null
     */
    public function update(): ?Update
    {
        return $this->update;
    }

    /**
     * @return int|null
     */
    public function chatId(): ?int
    {
        return $this->update?->getChat()?->id;
    }

    /**
     * @return Chat|null
     */
    public function chat(): ?Chat
    {
        return $this->update?->getChat();
    }

    /**
     * @return int|null
     */
    public function userId(): ?int
    {
        return $this->update?->getUser()?->id;
    }

    /**
     * @return User|null
     */
    public function user(): ?User
    {
        return $this->update?->getUser();
    }

    /**
     * @return int|null
     */
    public function messageId(): ?int
    {
        return $this->update?->getMessage()?->message_id;
    }

    /**
     * @return Message|null
     */
    public function message(): ?Message
    {
        return $this->update?->getMessage();
    }

    /**
     * @return bool
     */
    public function isCallbackQuery(): bool
    {
        return $this->update?->callback_query !== null;
    }

    /**
     * @return CallbackQuery|null
     */
    public function callbackQuery(): ?CallbackQuery
    {
        return $this->update?->callback_query;
    }

    /**
     * @return bool
     */
    public function isInlineQuery(): bool
    {
        return $this->update?->inline_query !== null;
    }

    /**
     * @return InlineQuery|null
     */
    public function inlineQuery(): ?InlineQuery
    {
        return $this->update?->inline_query;
    }

    /**
     * @return ChosenInlineResult|null
     */
    public function chosenInlineResult(): ?ChosenInlineResult
    {
        return $this->update?->chosen_inline_result;
    }

    /**
     * @return ShippingQuery|null
     */
    public function shippingQuery(): ?ShippingQuery
    {
        return $this->update?->shipping_query;
    }

    /**
     * @return bool
     */
    public function isPreCheckoutQuery(): bool
    {
        return $this->update?->pre_checkout_query !== null;
    }

    /**
     * @return PreCheckoutQuery|null
     */
    public function preCheckoutQuery(): ?PreCheckoutQuery
    {
        return $this->update?->pre_checkout_query;
    }

    /**
     * @return Poll|null
     */
    public function poll(): ?Poll
    {
        return $this->update?->poll;
    }

    /**
     * @return PollAnswer|null
     */
    public function pollAnswer(): ?PollAnswer
    {
        return $this->update?->poll_answer;
    }

    /**
     * @return bool
     */
    public function isMyChatMember(): bool
    {
        return $this->update?->my_chat_member !== null;
    }

    /**
     * @return ChatMemberUpdated|null
     */
    public function chatMember(): ?ChatMemberUpdated
    {
        return $this->update?->chat_member ?? $this->update?->my_chat_member;
    }

    /**
     * @return ChatJoinRequest|null
     */
    public function chatJoinRequest(): ?ChatJoinRequest
    {
        return $this->update?->chat_join_request;
    }

    /**
     * @return string|null
     */
    public function inlineMessageId(): ?string
    {
        return $this->chosenInlineResult()?->inline_message_id ??
            $this->callbackQuery()?->inline_message_id;
    }

    /**
     * @return bool
     */
    public function isCommand(): bool
    {
        /** @var MessageEntity $entity */
        $entity = $this->update?->message?->entities[0] ?? null;

        return $entity !== null &&
            $entity->offset === 0 &&
            $entity->type === MessageEntityType::BOT_COMMAND;
    }

    /**
     * @return MessageReactionUpdated|null
     */
    public function messageReaction(): ?MessageReactionUpdated
    {
        return $this->update?->message_reaction;
    }

    /**
     * @return MessageReactionCountUpdated|null
     */
    public function messageReactionCount(): ?MessageReactionCountUpdated
    {
        return $this->update?->message_reaction_count;
    }

    /**
     * @return ChatBoostUpdated|null
     */
    public function chatBoost(): ?ChatBoostUpdated
    {
        return $this->update?->chat_boost;
    }

    /**
     * @return ChatBoostRemoved|null
     */
    public function removedChatBoost(): ?ChatBoostRemoved
    {
        return $this->update?->removed_chat_boost;
    }

    /**
     * @return UsersShared|null
     */
    public function usersShared(): ?UsersShared
    {
        return $this->update?->getMessage()?->users_shared;
    }

    /**
     * @return GiveawayCreated|null
     */
    public function giveawayCreated(): ?GiveawayCreated
    {
        return $this->update?->getMessage()?->giveaway_created;
    }

    /**
     * @return Giveaway|null
     */
    public function giveaway(): ?Giveaway
    {
        return $this->update?->getMessage()?->giveaway;
    }

    /**
     * @return GiveawayWinners|null
     */
    public function giveawayWinners(): ?GiveawayWinners
    {
        return $this->update?->getMessage()?->giveaway_winners;
    }

    /**
     * @return GiveawayCompleted|null
     */
    public function giveawayCompleted(): ?GiveawayCompleted
    {
        return $this->update?->getMessage()?->giveaway_completed;
    }

}
