<?php

use App\Enum\TicketStatus;
use Illuminate\Support\Facades\Schema;
//use PHPUnit\Framework\Attributes\Ticket;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('status')->default(TicketStatus::OPEN->value);
            $table->string('attachment')->nullable();
            $table->bigInteger('user_id')->constrained();
            $table->bigInteger('status_changed_by_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
