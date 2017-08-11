#include<stdio.h> //printf
#include<string.h>    //strlen
#include<sys/socket.h>    //socket
#include<arpa/inet.h> //inet_addr
 #include <unistd.h>
#include<stdlib.h>
int main(int argc , char *argv[])
{
    int sock;
    struct sockaddr_in server;
    char message[200] , server_reply[100];
     
     
     printf("Help for user\n YOU MUST BE LOGGED IN TO USE THE COMMANDS\n\n\n ");
	printf("1.To submit contribution, enter the command in full--------'contribution amount date person_name receipt_number'\n Submit the details as shown in the command ");
	printf("\n2.To see how much has been contributed, enter the command in full-------'contribution check'\n");
	printf("\n3.To see how much has been recieved in benefits only, enter the command in full------'benefits check'");
	printf("\n\n4.To request for a loan, enter the command-------'loan request amount'");
	printf("\n\n5.To check loan status(Accepted/Denied), enter the command------'loan status'");
	printf("\n\n6.To check the loan repayment details, enter the command------'loan repayment details'");
	printf("\n\n7.Simple idea description, enter the  command---------'idea name capital'\n");
	
	
     
    //Create socket
    sock = socket(AF_INET , SOCK_STREAM , 0);
    if (sock == -1)
    {
        printf("Could not create socket");
    }
    puts("Socket created");
     
    server.sin_addr.s_addr = inet_addr("127.0.0.1");
    server.sin_family = AF_INET;
    server.sin_port = htons( 8888 );
 
    //Connect to remote server
    if (connect(sock , (struct sockaddr *)&server , sizeof(server)) < 0)
    {
        perror("connect failed. Error");
        return 1;
    }
     
    puts("Connected\n");
     
    //communicating with server
   
   
        //printf("Enter message : \n");
        gets(message);
         
        //Send  data
        if( send(sock , message , sizeof(message) , 0) < 0)
        {
            puts("Send failed");
            return 1;
        }
         
        //Receive a reply from the server
       
        
        recv(sock , server_reply , sizeof(server_reply) , 0); 
       printf("%s",server_reply);
    
     
    close(sock);
    return 0;
}
