variable "aws_region" {
  type        = string
  description = "The AWS region to put the bucket into"
  default     = "us-east-1"
}

variable "ami" {
  description = "The ami id of the base image."
  type        = string
  default     = "ami-0fc5d935ebf8bc3bc" # ubuntu 22.04 LTS
}

variable "instance_type" {
  description = "The instance type for the EC2 instance."
  type        = string
  default     = "t2.micro"
}

variable "key_name" {
  description = "The name of the EC2 key pair for SSH access."
  type        = string
  default     = "dynamic-php-application"
}

variable "subnet_id" {
  description = "The name of the subnet id."
  type        = string
  default     = "subnet-007567bcb4c0bd7a9"
}

variable "instance_name" {
  description = "The name of the EC2 instance."
  type        = string
  default     = "dynamic-php-application-instance"
}
